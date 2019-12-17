@extends('layouts.app')

@section('content')

<script>
    function getFollowers(user_name) {
        fetch('https://api.github.com/users/' + user_name + '/followers', {
            mode: 'cors'
        }).then(function(response) {
            return response.json();
        }).then(function(myJson) {
            console.log(JSON.stringify(myJson));
            document.getElementById('followers').innerHTML = views_followers(myJson);

        }).catch(function(error) {
            console.warn(error);
        });
    }

    function views_followers(followers) {
        let render_html = "";
        followers.forEach(function(follower) {
            render_html += '\
            <a href="' + follower.html_url + '" target="_blank"> \
            <img src="' + follower.avatar_url + '" class="col-md-3 mb-4 rounded float-left" alt=""> \
            </a> \
            ';
        });

        console.log(render_html);
        return render_html;
    }
</script>

<div class="container">
    <div class="row justify-content-center">
        <div>
            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif

            <div class="card mb-4" style="max-width: 540px;">
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <img src="{{ Auth::user()->avatar }}" class="card-img" alt="profile_image">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">{{ Auth::user()->name }}</h5>
                            <p class="card-text">Name: {{ Auth::user()->nickname }}</p>
                            <p class="card-text">Mail: {{ Auth::user()->mail }}</p>
                            <p class="card-text"><small class="text-muted">Last updated {{ Auth::user()->updated_at }}</small></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Followers</div>

                <div class="card-body">
                    <div id="followers">
                    </div>



                    <script>
                        getFollowers("{{ Auth::user()->name }}")
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection