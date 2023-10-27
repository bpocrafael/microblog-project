@if ($paginator->hasPages())
	<div class="row justify-content-center m-4">
		<div class="col-auto">
			<nav>
				<ul class="pagination">
					{{-- Go to First Page Link --}}
					@if (!$paginator->onFirstPage())
						<li class="page-item">
							<a class="page-link" href="{{ $paginator->url(1) }}" rel="prev">
								<i class="fa-solid fa-angles-right fa-rotate-180 fa-2xs"></i>
							</a>
						</li>
					@endif

					{{-- Previous Page Link --}}
					@if (!$paginator->onFirstPage())
						<li class="page-item">
							<a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">
								<i class="fa-solid fa-chevron-right fa-rotate-180 fa-2xs"></i>
							</a>
						</li>
					@endif

					{{-- Page Number Links (Limited to 5 Pages) --}}
					@php
						$startPage = max($paginator->currentPage() - 2, 1);
						$endPage = min($paginator->currentPage() + 2, $paginator->lastPage());
					@endphp

					@for ($page = $startPage; $page <= $endPage; $page++)
						@if ($page == $paginator->currentPage())
							<li class="page-item active"><span class="page-link">{{ $page }}</span></li>
						@else
							<li class="page-item"><a class="page-link" href="{{ $paginator->url($page) }}">{{ $page }}</a></li>
						@endif
					@endfor

					{{-- Next Page Link --}}
					@if ($paginator->hasMorePages())
						<li class="page-item">
							<a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">
								<i class="fa-solid fa-chevron-right fa-2xs"></i>
							</a>
						</li>
					@endif

					{{-- Go to Last Page Link --}}
					@if ($paginator->hasMorePages())
						<li class="page-item">
							<a class="page-link" href="{{ $paginator->url($paginator->lastPage()) }}" rel="next">
								<i class="fa-solid fa-angles-right fa-2xs"></i>
							</a>
						</li>
					@endif
				</ul>
			</nav>
		</div>
	</div>
@endif
