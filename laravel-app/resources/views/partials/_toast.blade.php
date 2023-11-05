<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
	<div class="toast hide" role="alert" aria-live="assertive" aria-atomic="true">
		<div class="toast-header alert-success">
			<label class="fw-bold text-share me-auto">Success</label>
			<button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
		</div>
		<div class="toast-body">
			{{ session('success') }}
		</div>
	</div>
</div>
