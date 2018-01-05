<div class="entire-screen navbar">
    <div class="third-screen center">
        <a href="/"><img src="/img/erasmus.png" width="50%"></a>
    </div>
    <div class="two-third-screen right">
        <ul>
            <li>
                @if (session('userID'))
                    <a href="/logout">Log Out</a>
                @else
                    <a href="/LogIn">Log In</a>
                @endif
            </li>
            <li>
                <a href="/information">More Info</a>
            </li>
            <li>
                @if (session('userID') != "admin")
                    <a href="/dashboard">Dashboard</a>
                @else
                    <a href="/">Home</a>
                @endif
            </li>
        </ul>
    </div>
</div>