@if (Session::has('success') || Session::has('error') || Session::has('warning') || Session::has('info') || $errors->any())
<div class="toast m-4" style="position: absolute; top: 0; right: 0; z-index: 1;">
  <div class="toast-header">
    @if ($notification = Session::get('success'))
    <strong class="me-auto text-success">Gimnasio</strong>
    @elseif ($notification = Session::get('error') or $errors->any())
    <strong class="me-auto text-danger">Gimnasio</strong>
    @elseif ($notification = Session::get('warning'))
    <strong class="me-auto text-warning">Gimnasio</strong>
    @elseif ($notification = Session::get('info'))
    <strong class="me-auto text-info">Gimnasio</strong>
    @endif

    <small class="text-muted">ahora</small>
    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
  </div>
  <div class="toast-body">
    @if ($errors->any())
    Por favor revisa el formulario y corrije los errores.
    @else
    {{ $notification }}.
    @endif
  </div>
</div>
@endif

<script>
  $(document).ready(function() {
    $(".toast").toast('show');
  });
</script>