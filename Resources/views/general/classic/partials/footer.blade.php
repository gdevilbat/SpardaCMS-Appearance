<footer class="footer-area mt-auto">
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    <div class="copyright d-flex justify-content-center">
                      <nav class="navbar-expand-lg">
                        <ul class="nav ml-auto">
                          <li class="border-right">
                            <span class="pr-1">Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved <i class="icofont icofont-heart-alt" aria-hidden="true"></i></span>
                          </li>
                          @foreach ($page_navbars as $navbar)
                              <li>
                                <a class="nav-link py-0 px-1" href="{{isset($navbar->slug) ? url($navbar->slug) : 'javascript:void(0)'}}" target="{{$navbar->target}}" title="{{$navbar->title}}">{{$navbar->text}}</a>
                              </li>
                          @endforeach
                        </ul>
                      </nav>
                    </div>
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                </div>
            </div>
        </div>
    </div>
</footer>