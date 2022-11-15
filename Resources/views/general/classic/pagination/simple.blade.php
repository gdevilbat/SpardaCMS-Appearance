@if ($paginator->hasPages())
    <?php
            /*=================================
            =            Paginator            =
            =================================*/

                $left =  $paginator->currentPage()% 5;

                if($paginator->lastPage() >= 5)
                {
                    if($paginator->lastPage() - ($paginator->currentPage() - ($left-1)) < 5)
                    {
                        $start_page = $paginator->lastPage() - (5-1);
                        $last_page = $paginator->lastPage();
                    }
                    else
                    {
                        if($left == 0)
                        {
                             $start_page = $paginator->currentPage() - (5-1);
                             $last_page = $start_page+(5-1);
                        }
                        else
                        {
                            $start_page = $paginator->currentPage() - ($left-1);
                            $last_page = $start_page+(5-1);
                        }
                    }
                }
                else
                {
                    $start_page = 1;
                    $last_page =$paginator->lastPage();
                }
            
            /*=====  End of Paginator  ======*/
    ?>
    <ul class="pagination">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="disabled invisible"><a href="javascript:void(0)" rel="prev">&lt;&lt;</a></a></li>
        @else
            <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev">&lt;&lt;</a></a></li>
        @endif

        {{-- Pagination Elements --}}
        @for ($i = $start_page; $i <= $last_page; $i++)
            @if ($i == $paginator->currentPage())
                <li class="active"><a href="javascript:void(0)" rel="prev">{{ $i }}</a></li>
            @else
                <li><a href="{{ $paginator->url($i) }}">{{ $i }}</a></li>
            @endif
        @endfor

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li><a href="{{ $paginator->nextPageUrl() }}" rel="next">&gt;&gt;</a></a></li>
        @else
            <li class="disabled invisible"><a href="javascript:void(0)" rel="prev">&gt;&gt;</a></a></li>
        @endif
    </ul>
@endif