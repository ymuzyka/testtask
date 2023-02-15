@extends('layouts.common')
@section('content')
    <div id="register">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <br><br>
                    <form action="{{ route('register.user') }}" method="post" id="register">
                        @csrf
                        <div class="form-group">
                            <label for="userName">User name</label>
                            <input type="text" name="name" class="form-control" id="userName">
                            @error('userName')
                            <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="phoneNumber">User phone</label>
                            <input type="tel" name="phone_number" class="form-control" id="phoneNumber">
                            @error('phoneNumber')
                            <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-success">Register</button>
                    </form>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <br><br>
                    <div class="alert alert-success" role="alert" id="link_div" hidden="hidden">
                        <p><span>Game link: </span> <a id="gameLink" href=""></a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('scripts')
    <script>
        $(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-Token': $('meta[name="_meta"]').prop('content'),
                },
            });

            $('#register').on('submit', (e) => {
                const form = $(e.target);
                e.preventDefault();
                let params = form.serializeArray();

                $.ajax({
                    url: form.attr('action'),
                    method: 'post',
                    dataType: 'json',
                    data: params,
                    success: (resp) => {
                        $('#link_div').removeAttr('hidden');
                        $('#gameLink').text(resp.link);
                        $('#gameLink').attr('href', resp.link)
                    },
                    error: (err) => {
                        alert("ERROR: " + err.responseJSON.message);
                    }
                })
            })
        });
    </script>
@stop
