<!DOCTYPE html>
<html lang="en">
@include('includes.head')

<body class="g-sidenav-show   bg-gray-100">
    <div class="min-height-300 bg-primary position-absolute w-100"></div>
    @include('includes.sidebar')
    <main class="main-content position-relative border-radius-lg ">
        @include('includes.navbar')
        <div class="container-fluid py-4">
            @yield('content')
        </div>
    </main>
    <!--   Core JS Files   -->
    <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/chartjs.min.js') }}"></script>
    <script>
        // var win = navigator.platform.indexOf('Win') > -1;
        // if (win && document.querySelector('#sidenav-scrollbar')) {
        //   var options = {
        //     damping: '0.5'
        //   }
        //   Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        // }
    </script>
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script src="{{ asset('assets/js/argon-dashboard.min.js?v=2.0.4') }}"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>

    @include('sweetalert::alert', ['cdn' => 'https://cdn.jsdelivr.net/npm/sweetalert2@9'])
    <script>
        $(document).ready(function() {
            $('.table').DataTable({
                "info": false,
                "pagingType": "full_numbers",
                "language": {
                    "paginate": {
                        "first": "&laquo;",
                        "previous": "&lsaquo;",
                        "next": "&rsaquo;",
                        "last": "&raquo;"
                    }
                }
            });
            $("#categoriesModal").click(function() {
                $('#categoryModal').modal('show');
            });
            $("#closeCategories").click(function() {
                $('#categoryModal').modal('hide');
            })
            $(".categoriesModalEdit").click(function() {
                var name = $(this).data('name');
                var id = $(this).data('id');
                $('#categoryNameEdit').val(name);
                $('#actionEditForm').attr("action",
                    "/dashboard/categories/" + id);
                $('#categoryEditModal').modal('show');
            });
            $("#closeCategoriesEdit").click(function() {
                $('#categoryEditModal').modal('hide');
            })
        });
    </script>
</body>

</html>
