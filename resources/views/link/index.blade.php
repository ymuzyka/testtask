@extends('layouts.common')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <br><br>
                <span>Game links: </span>
                <div id="game_links">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" checked>
                        <label class="form-check-label" for="flexRadioDefault1">
                            {{$link ?? ''}}
                        </label>
                    </div>
                </div>
                <br><br>
                <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                    <button type="button" class="btn btn-success" id="generate_new_link">Generate New Link</button>
                    <button type="button" class="btn btn-warning" id="deactivate_link">Deactivate Link</button>
                    <button type="button" class="btn btn-primary" id="play_game">Imfeelinglucky</button>
                    <button type="button" class="btn btn-secondary" id="show_history">Show History</button>
                </div>
                <br><br>
                <div class="control-group">
                    <div class="alert alert-success" role="alert">
                        Press 'Imfeelinglucky' to play game
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon3">Random number</span>
                        <input type="text" class="form-control" id="random_number" aria-describedby="basic-addon3">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon3">Is win number</span>
                        <input type="text" class="form-control" id="is_win_number" aria-describedby="basic-addon3">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon3">Win sum</span>
                        <input type="text" class="form-control" id="win_sum" aria-describedby="basic-addon3">
                    </div>
                </div>
                <br><br>
                <div class="control-group">
                    <div id="history"></div>
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
            $('#generate_new_link').on('click', (e) => {
                $.ajax({
                    url: "{{route('link.create')}}",
                    method: 'put',
                    dataType: 'json',
                    data: {},
                    success: (resp) => {
                        let linkHtml = `<div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                    <label class="form-check-label link_value" for="flexRadioDefault1">
                                        ` + resp.link +`
                                    </label>
                                 </div>`;
                        $('#game_links').append(linkHtml);
                    },
                    error: (err) => {
                        alert("ERROR: " + err.responseJSON.message);
                    }
                })
            })
            $('#deactivate_link').on('click', (e) => {
                const block = $("[name='flexRadioDefault']:checked").parent();
                const link = block.find('label').text().trim();

                $.ajax({
                    url: link,
                    method: 'post',
                    dataType: 'json',
                    success: (resp) => {
                        if (resp.status === 'success') {
                            block.remove();
                        }
                        if($('#game_links').html().trim() === '') {
                            window.location.href = "/";
                        }
                    },
                    error: (err) => {
                        alert("ERROR: " + err.responseJSON.message);
                    }
                })
            })
            $('#play_game').on('click', (e) => {
                $.ajax({
                    url: "{{route('game.play')}}",
                    method: 'post',
                    dataType: 'json',
                    success: (resp) => {
                        $('#random_number').val(resp.random_number);
                        $('#is_win_number').val(resp.is_win_number ? 'Win' : 'Lose');
                        $('#win_sum').val(resp.win_sum);
                    },
                    error: (err) => {
                        alert("ERROR: " + err.responseJSON.message);
                    }
                })
            })
            $('#show_history').on('click', (e) => {
                $.ajax({
                    url: "{{route('game.get_history')}}",
                    method: 'get',
                    dataType: 'json',
                    success: (resp) => {
                        const target = $('#history');
                        if (resp.history.length > 0) {
                            let table = `<table class="table table-bordered table-striped table-hover">
                                         <thead>
                                                <tr>
                                                  <th>Random number</th>
                                                  <th>Is win number</th>
                                                  <th>Win sum</th>
                                                </tr>
                                        </thead>`;
                            for (let i = 0; i < resp.history.length; i++) {
                                table += '<tr>';
                                table += '<td>' + resp.history[i].random_number + '</td>';
                                table += '<td>' + (resp.history[i].is_win_number ? "Win" : "Lose") + '</td>';
                                table += '<td>' + resp.history[i].win_sum + '</td>';
                                table += '</tr>';
                            }
                            table += '</table>';
                            target.html(table);
                        } else {
                            target.html('No history');
                        }
                    },
                    error: (err) => {
                        alert("ERROR: " + err.responseJSON.message);
                    }
                })
            })
        });
    </script>
@stop
