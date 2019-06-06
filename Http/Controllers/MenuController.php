<?php

namespace Gdevilbat\SpardaCMS\Modules\Appearance\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Gdevilbat\SpardaCMS\Modules\Core\Http\Controllers\CoreController;

use Gdevilbat\SpardaCMS\Modules\Taxonomy\Entities\Terms as Terms_m;
use Gdevilbat\SpardaCMS\Modules\Taxonomy\Entities\TermTaxonomy as TermTaxonomy_m;
use Gdevilbat\SpardaCMS\Modules\Taxonomy\Entities\TermMeta as TermMeta_m;
use Gdevilbat\SpardaCMS\Modules\Core\Repositories\Repository;

use Auth;
use Validator;

class MenuController extends CoreController
{
    public function __construct()
    {
        parent::__construct();
        $this->terms_m = new Terms_m;
        $this->terms_repository = new Repository(new Terms_m);
        $this->term_meta_m = new TermMeta_m;
        $this->term_meta_repository = new Repository(new TermMeta_m);
        $this->term_taxonomy_m = new TermTaxonomy_m;
        $this->term_taxonomy_repository = new Repository(new TermTaxonomy_m);
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $this->data['taxonomies'] = TermTaxonomy_m::with(['term'])
                                ->where(function($query){
                                    $query->where('taxonomy', 'category');                                        
                                })
                                ->whereDoesntHave('taxonomyParents', function($query){
                                    $query->where('taxonomy', 'category');                                        
                                })
                                ->get();

        $this->data['navbars'] = $this->getNavbars();

        return view('appearance::admin.'.$this->data['theme_cms']->value.'.content.Menu.master', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'menu' => 'required',
            'menu.*.term_id' => 'required'
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        }

        $menus = $request->input('menu');

        $taxonomy = $this->term_taxonomy_m->where('taxonomy', 'navbar')->delete();

        foreach ($menus as $key => $value) 
        {
            $taxonomy = $this->term_taxonomy_m->where(['term_id' => $value['term_id'], 'taxonomy' => 'navbar'])->first();
            if(empty($taxonomy))
            {
                $taxonomy = new $this->term_taxonomy_m;
                $taxonomy->created_by = Auth::id();
            }

            $taxonomy->term_id = $value['term_id'];
            $taxonomy->taxonomy = 'navbar';
            $taxonomy->menu_order = $key;
            $taxonomy->parent_id = null;
            $taxonomy->modified_by = Auth::id();
            $taxonomy->save();

            $metas = ['menu_text' => $value['text'], 'menu_title' => $value['title'], 'menu_target' => $value['target']];

            foreach ($metas as $key_meta => $value_meta) 
            {
                $termmeta = $this->term_meta_m->where(['term_id' => $value['term_id'], 'meta_key' => $key_meta])->first();
                if(empty($termmeta))
                {
                    $termmeta = new $this->term_meta_m;
                }

                $termmeta->meta_key = $key_meta;
                $termmeta->meta_value = $value_meta;
                $termmeta->term_id = $value['term_id'];
                $termmeta->save();
            }


            if(array_key_exists('children', $value))
            {
                $this->saveChildren($value['children'], $taxonomy->term_id);
            }
        }

        return 1;
    }

    private function saveChildren($children, $parent_id)
    {
        $validator = Validator::make($children, [
            'menu.*.term_id' => 'required'
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        }

        $menus = $children;

        foreach ($menus as $key => $value) 
        {
            $taxonomy = $this->term_taxonomy_m->where(['term_id' => $value['term_id'], 'taxonomy' => 'navbar'])->first();
            if(empty($taxonomy))
            {
                $taxonomy = new $this->term_taxonomy_m;
                $taxonomy->created_by = Auth::id();
            }

            $taxonomy->term_id = $value['term_id'];
            $taxonomy->taxonomy = 'navbar';
            $taxonomy->menu_order = $key;
            $taxonomy->parent_id = $parent_id;
            $taxonomy->modified_by = Auth::id();
            $taxonomy->save();

            $metas = ['menu_text' => $value['text'], 'menu_title' => $value['title'], 'menu_target' => $value['target']];

            foreach ($metas as $key_meta => $value_meta) 
            {
                $termmeta = $this->term_meta_m->where(['term_id' => $value['term_id'], 'meta_key' => $key_meta])->first();
                if(empty($termmeta))
                {
                    $termmeta = new $this->term_meta_m;
                }

                $termmeta->meta_key = $key_meta;
                $termmeta->meta_value = $value_meta;
                $termmeta->term_id = $value['term_id'];
                $termmeta->save();
            }

            if(array_key_exists('children', $value))
            {
                $this->saveChildren($value['children'], $taxonomy->term_id);
            }
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('appearance::show');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    public function getChild($object)
    {
        $model = $object->load(['taxonomyChildrens' => function($query){
                    $query->where('taxonomy', 'category');
                }, 'taxonomyChildrens.parent','taxonomyChildrens.term']);

        return $model;
    }

    public function loadNavbarChild($object)
    {
        $model = $object->load(['taxonomyChildrens' => function($query){
                    $query->where('taxonomy', 'navbar')
                           ->orderBy('menu_order');
                },'taxonomyChildrens.term.termMetas']);

        return $model;
    }

    private function getNavbars()
    {
        $model = TermTaxonomy_m::with('term.termMetas')
                                ->where('taxonomy', 'navbar')
                                ->whereDoesntHave('taxonomyParents', function($query){
                                    $query->where('taxonomy', 'navbar');
                                })
                                ->orderBy('menu_order')
                                ->get();

        $navbar = [];

        foreach ($model as $key_parent => $value_parent) 
        {
            $navbar[$key_parent]['text'] = !empty($value_parent->term->termMetas->where('meta_key', 'menu_text')->first()) ? $value_parent->term->termMetas->where('meta_key', 'menu_text')->first()->meta_value : '';
            $navbar[$key_parent]['term_id'] = $value_parent->term_id;
            $navbar[$key_parent]['parent_id'] = $value_parent->parent_id;
            $navbar[$key_parent]['title'] = !empty($value_parent->term->termMetas->where('meta_key', 'menu_title')->first()) ? $value_parent->term->termMetas->where('meta_key', 'menu_title')->first()->meta_value : '';
            $navbar[$key_parent]['target'] = !empty($value_parent->term->termMetas->where('meta_key', 'menu_target')->first()) ? $value_parent->term->termMetas->where('meta_key', 'menu_target')->first()->meta_value : '';

            if($this->loadNavbarChild($value_parent)->taxonomyChildrens->count() > 0)
            {
                $navbar[$key_parent]['children'] = $this->getNavbarsChild($value_parent);
            }
        }

        return $navbar;
        
    }

    public function getNavbarsChild($object)
    {
        $model = $this->loadNavbarChild($object);

        $navbar = [];

        foreach ($model->taxonomyChildrens as $key_parent => $value_parent) 
        {
            $navbar[$key_parent]['text'] = !empty($value_parent->term->termMetas->where('meta_key', 'menu_text')->first()) ? $value_parent->term->termMetas->where('meta_key', 'menu_text')->first()->meta_value : '';
            $navbar[$key_parent]['term_id'] = $value_parent->term_id;
            $navbar[$key_parent]['parent_id'] = $value_parent->parent_id;
            $navbar[$key_parent]['title'] = !empty($value_parent->term->termMetas->where('meta_key', 'menu_title')->first()) ? $value_parent->term->termMetas->where('meta_key', 'menu_title')->first()->meta_value : '';
             $navbar[$key_parent]['target'] = !empty($value_parent->term->termMetas->where('meta_key', 'menu_target')->first()) ? $value_parent->term->termMetas->where('meta_key', 'menu_target')->first()->meta_value : '';

            if($this->loadNavbarChild($value_parent)->taxonomyChildrens->count() > 0)
            {
                $navbar[$key_parent]['children'] = $this->getNavbarsChild($value_parent);
            }
        }

        return $navbar;
    }
}
