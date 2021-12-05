<footer class="footer py-4  ">
    <div class="container-fluid">
        <div class="row align-items-center justify-content-lg-between">
            <div class="col-lg-6 mb-lg-0 mb-4">
                <div class="copyright text-center text-sm text-muted text-lg-start">
                    Made with <i class="fa fa-heart"></i> by
                    <a href="#" class="font-weight-bold">Ahmad Husban</a>
                    for Ingot Brokers.
                </div>
            </div>
        </div>
    </div>
</footer>

<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
    @csrf
</form>
