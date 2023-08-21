  <!-- Include jQuery library -->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <!-- Include Bootstrap JS -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <!-- Include Cropper.js -->
  <script src="https://cdn.jsdelivr.net/npm/cropme@latest/dist/cropme.min.js"></script>

  <!-- Include your loader.js and image_upload.js scripts -->
  <script src="{{ asset('js/loader.js') }}"></script>
  <script src="{{ asset('js/image_upload.js') }}"></script>
  @yield('custom-js')
</body>
</html>
