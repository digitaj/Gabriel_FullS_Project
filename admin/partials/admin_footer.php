 <!-- Bootstrap Bundle -->
    <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script>
        // Simple Sidebar Toggle Script
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebar = document.getElementById('sidebar');
        if (sidebarToggle) {
            sidebarToggle.addEventListener('click', () => {
                sidebar.classList.toggle('show');
            });
        }
    </script>
</body>

</html>