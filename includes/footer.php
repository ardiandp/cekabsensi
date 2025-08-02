        <!-- Footer -->
        <footer class="footer bg-light p-3">
            <div class="container-fluid">
                <div class="d-flex justify-content-between align-items-center">
                    <span class="text-muted">© 2023 Admin Panel</span>
                    <span class="text-muted">Version 1.0.0</span>
                </div>
            </div>
        </footer>
    </div> <!-- .wrapper -->

    <!-- jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <!-- Bootstrap JS CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom JS -->
    <script>
        // Toggle sidebar on mobile
        $(document).ready(function() {
            $('#sidebarToggle').click(function() {
                $('.sidebar').toggleClass('active');
                $('.content').toggleClass('active');
            });
        });
    </script>
</body>
</html>