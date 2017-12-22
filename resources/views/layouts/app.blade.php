
@section('navbar')

@show

<div class="entire-screen navbar">
    <div class="third-screen center">
        <a href="/"><img src="/img/erasmus.png" width="50%"></a>
    </div>
    <div class="two-third-screen right">
        <ul>
            <li>
                Home
            </li>
            <li>
                More Info
            </li>
            <li>

                 @yield('action')
            </li>
        </ul>
    </div>
</div>

@section('footer')

@show
    <div class="entire-screen blue-theme">
        <div class="third-screen">
            <h5></h5>
        </div>
        <div class="third-screen center">
            <ul>
                <li>
                    <a href="#"><i class="fa fa-facebook fa-2x" aria-hidden="true"></i></a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-instagram fa-2x" aria-hidden="true"></i></a>
                </li>
            </ul>
        </div>
        <div class="third-screen center">
            <h4>Copyright ERASMUS+</h4>
        </div>
    </div>
</body>
</html>