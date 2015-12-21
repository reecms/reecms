<nav class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">
                Ree CMS
            </a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <form class="navbar-form navbar-right" role="search">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Search">
                </div>
                <button type="submit" class="btn btn-default">
                    @lang('common.top_bar.search_button')
                </button>
            </form>
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="#">
                        @lang('common.top_bar.sign_in')
                    </a>
                </li>
                <li>
                    <a href="#">
                        @lang('common.top_bar.sign_up')
                    </a>
                </li>
                <li>
                    <a href="#">
                        @lang('common.top_bar.help')
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>