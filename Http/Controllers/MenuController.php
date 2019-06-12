<?php

namespace Gdevilbat\SpardaCMS\Modules\Appearance\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Gdevilbat\SpardaCMS\Modules\Core\Http\Controllers\CoreController;

use Gdevilbat\SpardaCMS\Modules\Taxonomy\Entities\Terms as Terms_m;
use Gdevilbat\SpardaCMS\Modules\Taxonomy\Entities\TermTaxonomy as TermTaxonomy_m;
use Gdevilbat\SpardaCMS\Modules\Taxonomy\Entities\TermMeta as TermMeta_m;
use Gdevilbat\SpardaCMS\Modules\Post\Entities\Post as Post_m;
use Gdevilbat\SpardaCMS\Modules\Post\Entities\PostMeta as PostMeta_m;
use Gdevilbat\SpardaCMS\Modules\Core\Repositories\Repository;

use Auth;
use Validator;

class MenuController extends CoreController
{
    protected $taxonomy_menu = ['category'];

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
        $this->data['posts'] = Post_m::where(function($query){
                                            $query->where('post_type', 'page');
                                        })
                                        ->where('post_status', 'publish')
                                        ->get();

        $this->data['taxonomies'] = TermTaxonomy_m::with(['term'])
                                ->where(function($query){
                                    $query->whereIn('taxonomy', $this->taxonomy_menu);                                        
                                })
                                ->whereDoesntHave('taxonomyParents', function($query){
                                    $query->whereIn('taxonomy', $this->taxonomy_menu);                                        
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
        $menus = $request->input('menu');

        $taxonomy = $this->term_taxonomy_m->where('taxonomy', 'navbar')->delete();

        if(!empty($menus))
        {
            foreach ($menus as $key => $value) 
            {
                /*=======================================
                =            Taxonomies Menu            =
                =======================================*/
                
                    if(!empty($value['term_id']))
                    {
                        if(empty($value['parent_id']))
                        {
                            $taxonomy = $this->term_taxonomy_m->where(['term_id' => $value['term_id'], 'taxonomy' => 'navbar'])->first();
                            if(empty($taxonomy))
                            {
                                $taxonomy = new $this->term_taxonomy_m;
                                $taxonomy->created_by = Auth::id();
                            }

                            $taxonomy->term_id = $value['term_id'];
                            $taxonomy->taxonomy = 'navbar';
                            $taxonomy->parent_id = null;
                            $taxonomy->modified_by = Auth::id();
                            $taxonomy->save();

                            $metas = ['menu_text' => $value['text'], 'menu_title' => $value['title'], 'menu_target' => $value['target'], 'menu_order' => $key];

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
                
                /*=====  End of Taxonomies Menu  ======*/

                /*=================================
                =            Post Menu            =
                =================================*/
                
                    if(!empty($value['post_id']))
                    {
                        $post = Post_m::find($value['post_id']);
                        $post->menu_order = $key;
                        $post->save();

                        $metas = ['menu_text' => $value['text'], 'menu_title' => $value['title'], 'menu_target' => $value['target']];

                        foreach ($metas as $key_meta => $value_meta) 
                        {
                            $post = PostMeta_m::where(['post_id' => $value['post_id'], 'meta_key' => $key_meta])->first();
                            if(empty($post))
                            {
                                $post = new PostMeta_m;
                            }

                            $post->meta_key = $key_meta;
                            $post->meta_value = $value_meta;
                            $post->post_id = $value['post_id'];
                            $post->save();
                        }
                    }
                
                /*=====  End of Post Menu  ======*/
            }
        }


        return 1;
    }

    private function saveChildren($children, $parent_id)
    {
        $menus = $children;

        foreach ($menus as $key => $value) 
        {
            /*=======================================
            =            Taxonomies Menu            =
            =======================================*/
            
                if(!empty($value['term_id']))
                {
                    if($parent_id == $value['parent_id'])
                    {
                        $taxonomy = $this->term_taxonomy_m->where(['term_id' => $value['term_id'], 'taxonomy' => 'navbar'])->first();
                        if(empty($taxonomy))
                        {
                            $taxonomy = new $this->term_taxonomy_m;
                            $taxonomy->created_by = Auth::id();
                        }

                        $taxonomy->term_id = $value['term_id'];
                        $taxonomy->taxonomy = 'navbar';
                        $taxonomy->parent_id = $parent_id;
                        $taxonomy->modified_by = Auth::id();
                        $taxonomy->save();

                        $metas = ['menu_text' => $value['text'], 'menu_title' => $value['title'], 'menu_target' => $value['target'], 'menu_order' => $key];

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
            
            /*=====  End of Taxonomies Menu  ======*/
            
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
                    $query->whereIn('taxonomy', $this->taxonomy_menu);
                }, 'taxonomyChildrens.parent','taxonomyChildrens.term']);

        return $model;
    }

    private function loadNavbarChild($object)
    {
        $model = $object->load(['taxonomyChildrens' => function($query){
                    $query->where('taxonomy', 'navbar');
                },'taxonomyChildrens.term.termMeta']);

        return $model;
    }

    public function getNavbars()
    {
        $model = TermTaxonomy_m::with('term.termMeta')
                                ->where('taxonomy', 'navbar')
                                ->whereDoesntHave('taxonomyParents', function($query){
                                    $query->where('taxonomy', 'navbar');
                                })
                                ->get();

        $navbar = [];

        foreach ($model as $key_parent => $value_parent) 
        {
            $navbar[$key_parent]['text'] = !empty($value_parent->term->termMeta->where('meta_key', 'menu_text')->first()) ? $value_parent->term->termMeta->where('meta_key', 'menu_text')->first()->meta_value : $value_parent->term->name;
            $navbar[$key_parent]['term_id'] = $value_parent->term_id;
            $navbar[$key_parent]['parent_id'] = $value_parent->parent_id;
            $navbar[$key_parent]['slug'] = $this->getTaxonomyType($value_parent->term->slug).'/'.$value_parent->term->slug;
            $navbar[$key_parent]['menu_order'] = !empty($value_parent->term->termMeta->where('meta_key', 'menu_order')->first()) ? $value_parent->term->termMeta->where('meta_key', 'menu_order')->first()->meta_value : 0;
            $navbar[$key_parent]['title'] = !empty($value_parent->term->termMeta->where('meta_key', 'menu_title')->first()) ? $value_parent->term->termMeta->where('meta_key', 'menu_title')->first()->meta_value : '';
            $navbar[$key_parent]['target'] = !empty($value_parent->term->termMeta->where('meta_key', 'menu_target')->first()) ? $value_parent->term->termMeta->where('meta_key', 'menu_target')->first()->meta_value : '';

            if($this->loadNavbarChild($value_parent)->taxonomyChildrens->count() > 0)
            {
                $navbar[$key_parent]['children'] = $this->getNavbarsChild($value_parent, $value_parent->term->slug);
            }
        }

        $model = Post_m::with('postMeta')
                           ->where(function($query){
                                            $query->where('post_type', 'page');
                            })
                           ->where('post_status', 'publish')
                           ->get();

        $post = [];

        foreach ($model as $key_parent => $value_parent) 
        {
            $post[$key_parent]['text'] = !empty($value_parent->postMeta->where('meta_key', 'menu_text')->first()) ? $value_parent->postMeta->where('meta_key', 'menu_text')->first()->meta_value : $value_parent->post_title;
            $post[$key_parent]['post_id'] = $value_parent->id;
            $post[$key_parent]['slug'] = $value_parent->post_slug;
            $post[$key_parent]['menu_order'] = $value_parent->menu_order;
            $post[$key_parent]['title'] = !empty($value_parent->postMeta->where('meta_key', 'menu_title')->first()) ? $value_parent->postMeta->where('meta_key', 'menu_title')->first()->meta_value : '';
            $post[$key_parent]['target'] = !empty($value_parent->postMeta->where('meta_key', 'menu_target')->first()) ? $value_parent->postMeta->where('meta_key', 'menu_target')->first()->meta_value : '';
        }

        foreach ($post as $value) 
        {
            array_push($navbar, $value);
        }

        $navbar = collect($navbar)->sortBy('menu_order')->toArray();

        return array_values($navbar);        
    }

    private function getNavbarsChild($object, $parent_slug)
    {
        $model = $this->loadNavbarChild($object);

        $navbar = [];

        foreach ($model->taxonomyChildrens as $key_parent => $value_parent) 
        {
            $navbar[$key_parent]['text'] = !empty($value_parent->term->termMeta->where('meta_key', 'menu_text')->first()) ? $value_parent->term->termMeta->where('meta_key', 'menu_text')->first()->meta_value : $value_parent->term->name;
            $navbar[$key_parent]['term_id'] = $value_parent->term_id;
            $navbar[$key_parent]['parent_id'] = $value_parent->parent_id;
            $navbar[$key_parent]['slug'] = $this->getTaxonomyType($parent_slug.'/'.$value_parent->term->slug).'/'.$parent_slug.'/'.$value_parent->term->slug;
            $navbar[$key_parent]['menu_order'] = !empty($value_parent->term->termMeta->where('meta_key', 'menu_order')->first()) ? $value_parent->term->termMeta->where('meta_key', 'menu_order')->first()->meta_value : 0;
            $navbar[$key_parent]['title'] = !empty($value_parent->term->termMeta->where('meta_key', 'menu_title')->first()) ? $value_parent->term->termMeta->where('meta_key', 'menu_title')->first()->meta_value : '';
            $navbar[$key_parent]['target'] = !empty($value_parent->term->termMeta->where('meta_key', 'menu_target')->first()) ? $value_parent->term->termMeta->where('meta_key', 'menu_target')->first()->meta_value : '';

            if($this->loadNavbarChild($value_parent)->taxonomyChildrens->count() > 0)
            {
                $navbar[$key_parent]['children'] = $this->getNavbarsChild($value_parent, $parent_slug.'/'.$value_parent->term->slug);
            }
        }

        return $navbar;
    }

    public function getTaxonomyObject($slug)
    {
        $slug = explode('/', $slug);
        $slug_array = collect($slug)->reverse();

        $slug = $slug_array->shift();

        $taxonomy = $this->term_taxonomy_m->whereIn('taxonomy', $this->taxonomy_menu)
                                          ->whereHas('term', function($query) use ($slug){
                                            $query->where('slug', $slug);
                                          });

        /*=================================================
        =            Get Taxonomy Relationship            =
        =================================================*/
        
            $parent = [];

            foreach ($slug_array as $key => $value) 
            {
                array_push($parent, 'taxonomyParents');
            }

            $parent = implode('.', $parent);
        
            if(!empty($parent))
            {
                $taxonomy = $taxonomy->whereHas($parent.'.term', function($query) use ($slug_array){
                                        $query->where('slug', $slug_array->last());
                                    });
            }
        /*=====  End of Get Taxonomy Relationship  ======*/
        
        $taxonomy = $taxonomy->first();

        return $taxonomy;
    }

    private function getTaxonomyType($slug)
    {
        $taxonomy = $this->getTaxonomyObject($slug);

        $type = $taxonomy->taxonomy;

        return $type;
    }
}
