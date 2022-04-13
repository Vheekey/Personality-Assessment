<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Personality Assessment</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4">

                    <form action="{{ route('assessment.register.'.$records->currentPage().'.store') }}" method="post">
                        @csrf
                        @foreach ($records as $item)
                            <div class="card mt-5">
                                <div class="card-header">
                                    {{ $item->id }}.
                                    {{ $item->question }}
                                </div>
                                <div class="card-body">
                                    @foreach ($item->answers as $value)
                                        <p></p>
                                        <div class="input-group mr-5">
                                            <div class="input-group-prepend mr-5">
                                                <div class="input-group-text mr-5">
                                                    <input type="radio" name="answer{{ $item->id }}" aria-label="{{ $value->answer }}" class="mr-5" value="{{ $value->answer.$value->points }}" required>
                                                    <label class="ml-5 px-2">{{ $value->answer }}</label>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="mt-3">
                                <a href="javascript:history.back()" class="btn btn-sm btn-dark {{$records->onFirstPage() ? 'disabled' : ''}}">
                                    Previous
                                </a>


                                <input type="submit" class="btn btn-sm btn-success" value="{{ $records->onLastPage() ? 'Submit' : 'Next'  }}">
                            </div>
                        @endforeach

                </form>
            </div>
        </div>
    </body>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</html>
