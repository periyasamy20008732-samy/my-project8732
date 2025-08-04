    <!-- ======= Footer ======= -->
  {{--  <footer id="footer" class="footer">
        <div class="copyright">
            &copy; Copyright <strong><span>Ecome</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
            <!-- All the links in the footer should remain intact. -->
            <!-- You can delete the links only if you purchased the pro version. -->
            <!-- Licensing information: https://bootstrapmade.com/license/ -->
            <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
            Designed by <a href="https://greencreon.com">Greencreon</a>
        </div>
    </footer><!-- End Footer -->--}}


    <!-- Template Main JS File -->
    <script src="{{asset('admin-assets/js/main.js')}}"></script>
<!-- Add SweetAlert2 CDN -->
       <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <!-- jQuery -->
	<script src="{{asset('admin-assets/js/jquery-3.7.1.min.js')}}"></script>

	<!-- Feather Icon JS -->
	<script src="{{asset('admin-assets/js/feather.min.js')}}"></script>

	<!-- Slimscroll JS -->
	<script src="{{asset('admin-assets/js/jquery.slimscroll.min.js')}}"></script>

	<!-- Bootstrap Core JS -->
	<script src="{{asset('admin-assets/js/bootstrap.bundle.min.js')}}"></script>

	<!-- Chart JS -->
	<script src="{{asset('admin-assets/plugins/apexchart/apexcharts.min.js')}}"></script>
	<script src="{{asset('admin-assets/plugins/apexchart/chart-data.js')}}"></script>

	<!-- Sweetalert 2 -->
	<script src="{{asset('admin-assets/plugins/sweetalert/sweetalert2.all.min.js')}}"></script>
	<script src="{{asset('admin-assets/plugins/sweetalert/sweetalerts.min.js')}}"></script>

	<!-- Custom JS -->
	<script src="{{asset('admin-assets/js/theme-script.js')}}"></script>	
		<script src="{{asset('admin-assets/js/script.js')}}"></script>

<!-- jQuery (must be loaded before DataTables) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



<!-- Feather icons (optional, for icons used in blade) -->
<script src="https://unpkg.com/feather-icons"></script>

<!-- SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/2.3.2/js/dataTables.min.js"></script>


<!-- JavaScript: Feather icons, tooltip, refresh, and collapse -->
<script>
document.addEventListener("DOMContentLoaded", function () {
    // Initialize feather icons
    feather.replace();

    // Bootstrap tooltip initialization
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.forEach(function (tooltipTriggerEl) {
        new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Refresh button
    document.getElementById("refresh-btn").addEventListener("click", function () {
        location.reload();
    });

    // Collapse header toggle
    const collapseBtn = document.getElementById("collapse-header");
    const headerSection = document.getElementById("header-section");
    const icon = document.getElementById("collapse-icon");

    collapseBtn.addEventListener("click", function () {
        if (headerSection.style.display === "none") {
            headerSection.style.display = "flex"; // Restore flex layout
            icon.setAttribute("data-feather", "chevron-up");
            icon.title = "Collapse";
        } else {
            headerSection.style.display = "none";
            icon.setAttribute("data-feather", "chevron-down");
            icon.title = "Expand";
        }
        feather.replace(); // Re-render feather icons
    });
});
</script>





        <script>
	$(document).ready(function() {
    $('.submenu > a').on('click', function(e) {
        e.preventDefault();
        var $submenu = $(this).next('ul');
        if (!$submenu.is(':visible')) {
            $('.submenu ul').slideUp(300);
            $submenu.slideDown(300);
        } else {
            $submenu.slideUp(300);
        }
    });
});

</script>

</body>

</html>
