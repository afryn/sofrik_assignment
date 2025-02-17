<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Hello, world!</title>
    <style>
        .success {
            color: green;
            padding: 10px;
            background-color: #c4edc4;
        }
        .error{
            color: red;
            padding: 10px;
            background-color:rgb(237, 196, 196);
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                  
                    @if(auth()->check('user'))
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{route('home')}}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{route('bookings')}}">My Bookings</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{route('logout')}}">Logout</a>
                    </li>
                    @else
                      <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{route('login')}}">Login</a>
                    </li>
                      <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{route('register')}}">Register</a>
                    </li>
                    @endif
                   
                </ul>
             
            </div>
        </div>
    </nav>
    <div class="container">
        <h2>Events</h2>
        <p class="msg" style="display: none;"></p>

        <div class="  outer  ">
            <div class=" d-flex flex-wrap inner">

                @foreach ($events as $key => $event)
                    <div class="card col-6 m-1" style="width: 45%;">
                        <div class="card-body">
                            <h5 class="card-title">{{ $event->title }}</h5>
                            <h6 class="card-subtitle mb-2 text-muted"><b>Event Date:</b>
                                {{ date('d M Y', strtotime($event->event_date)) }}</h6>
                            <p class="card-text"><b>Venue:</b> {{ $event->venue }}</p>
                            @if ($event->seats_count)
                                <span class="badge bg-danger"><span class="fs-5">{{ $event->seats_count }}</span>
                                    Seats Remaining</span><br>
                                <form action="{{ route('book.ticket.post') }}" class="ajaxFormSubmit" method="post">
                                    @csrf
                                    <input type="hidden" name="event_id" value="{{ $event->id }}">
                                    <button class="btn btn-primary my-1 submit_btn">Book
                                        Ticket</button>
                                </form>
                            @else
                                <h6 class="card-subtitle mb-2 text-danger">No Seats Available</h6>
                            @endif
                        </div>
                    </div>
                @endforeach


            </div>
        </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>

    <script>
        $(document).on('submit', '.ajaxFormSubmit', function(e) {
            $('.submit_btn').attr('disabled', true);
            e.preventDefault()
            var formdata = new FormData($(this)[0])

            $.post({
                url: $(this).attr('action'),
                data: formdata,
                contentType: false,
                processData: false,
                success: function(data) {
                    $('.submit_btn').removeAttr('disabled');
                    console.log(data)
                    if (data.status) {
                        $(".msg").addClass('success')
                        var url = window.location.href;
                        $('.outer').load(url + ' .inner')
                    } else {
                        $(".msg").addClass('error')
                    }
                    $(".msg").text(data.msg)
                    $(".msg").show()
                    setTimeout(() => {
                        $(".msg").hide()
                    }, 2000);
                },
            });
        })
    </script>
</body>

</html>
