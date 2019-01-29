<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">

        <!--<link href="{{ asset('css/app.css') }}" rel="stylesheet">-->
        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.3.3/vue.common.js"></script>
        <script src="/js/app.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!--<script src="{{ asset('js/bootstrap.js') }}"></script>-->

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    </head>
    <body>


      <div class="container">
        <h1>Products (Add Comments)</h1>
        <p>General information displayed about each product and the ability to add comments.</p>

        @if (session('errorflag'))
        <div class="alert alert-danger">
          {{ session('errorflag') }}
        </div>
        @endif
        @if (session('successflag'))
        <div class="alert alert-success">
          {{ session('successflag') }}
        </div>
        @endif

        <table class="table table-hover">
          <thead>
            <tr>
              <th>Product Name</th>
              <th>Description</th>
              <th>Price</th>
              <th>Quantity</th>
              <th>&nbsp;</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($products as $productinfo)
            <tr>
              <td>{{ $productinfo->title }}</td>
              <td>{{ $productinfo->desc }}</td>
              <td>${{ $productinfo->price }}</td>
              <td>{{ $productinfo->inventory->quantity }}</td>
              <td><button type="button" class="btn btn-info btn-sml" data-toggle="modal" data-target="#myModal{{ $productinfo->id }}">Add Comments</button></td>
            </tr>
            @endforeach
          </tbody>
        </table>

        <!-- Modals -->
        @foreach ($products as $productinfo)
        <div class="modal fade" id="myModal{{ $productinfo->id }}" role="dialog">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Add Comments for {{ $productinfo->title }}</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              <div class="modal-body">
                <form action="/comments" method="post">
                  <div class="form-group">
                    <label for="comments">Comments:</label>
                    <input type="text" class="form-control" id="comments" placeholder="Enter Comments" name="comments">
                  </div>
                  {{ csrf_field() }}
                  <input type="hidden" name="pid" id="pid" value="{{ $productinfo->id }}">
                  <button type="submit" class="btn btn-default">Submit</button>
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
        @endforeach


      </div>


    </body>
</html>
