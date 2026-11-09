@if ($paginator->hasPages())

    <style>
        .paginacion-container {
            display: flex;
            justify-content: center;
            margin-top: 30px;
        }
        .paginacion {
            list-style: none;
            display: flex;
            gap: 6px;
            padding: 0;
        }
        .paginacion li a,span {
            display: block;
            padding: 8px 12px;
            border: 1px solid #003f5c;
            border-radius: 6px;
            text-decoration: none;
            font-weight: bold;
            color: #003f5c;
            background-color: white;
            transition: all 0.3s ease-in-out;
        }
        .paginacion li a:hover {
            background-color: #009FA8;
            color: white;
            border-color: #009FA8;
            transform: scale(1.05);
        }
        .paginacion li.active span {
            background-color: #009FA8;
            color: white;
            border-color: #009FA8;
        }
        .paginacion li.disabled span {
            color: #aaa;
            background-color: #f0f0f0;
            border-color: #ccc;
        }
    </style>

    <nav class="paginacion-container">
        <ul class="paginacion">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="disabled" aria-disabled="true">
                    <span>&lsaquo;</span>
                </li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev">&lsaquo;</a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                @if (is_string($element))
                    <li class="disabled"><span>{{ $element }}</span></li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="active"><span>{{ $page }}</span></li>
                        @else
                            <li><a href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next">&rsaquo;</a>
                </li>
            @else
                <li class="disabled" aria-disabled="true">
                    <span>&rsaquo;</span>
                </li>
            @endif
        </ul>
    </nav>
@endif
