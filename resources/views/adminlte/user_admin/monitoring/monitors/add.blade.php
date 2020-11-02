@extends('adminlte::page')
@section('title', 'Add')

@section('content_header')
    <h1>Monitoring > Monitors > Add</h1>
@stop

@section('content')
    <section class="monitoringAdd">

        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
            Launch demo modal
        </button>
    
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="monitoringAddMenu">
                        <div class="monitoringAddMenu_Header">
                            <div class="monitoringAddMenu_title">Add monitor</div>
                            <div class="monitoringAddMenu_line"></div>
                        </div>
                        <div class="monitoringAddMenuItemWrapper">
                            <div class="monitoringAddMenu_Item">Alert setting</div>
                            <div class="monitoringAddMenu_Item">Authentication Parameters</div>
                            <div class="monitoringAddMenu_Item">SSL Monitoring</div>
                            <div class="monitoringAddMenu_Item">Custom HTTP Header</div>
                            <div class="monitoringAddMenu_Item">Advanced Monitoring Settings</div>
                            <div class="monitoringAddMenu_Item">Alert Fine Tuning</div>
                            <div class="monitoringAddMenu_Item">SSL Monitoring</div>
                        </div>
                    </div>
                    <div class="monitoringAddSettings">
                        <div class="monitoringAddSettings_header">
                            <div class="monitoringAddMenu_title">MONITOR INFORMATION</div>
                            <div class="monitoringAddMenu_line"></div>
                        </div>
                        <div class="monitoringAddSettings_items">
                            Check type
                            <div class="checkTypes">
                                <div class="checkType">

                                </div>
                                <div class="checkType">
                                    
                                </div>
                                <div class="checkType">
                                    
                                </div>
                                <div class="checkType">
                                    
                                </div>
                            </div>
                            host namee
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
@stop
@section('css')
    <link rel="stylesheet" href="/css/app.css">
@stop

@section('js')
    <script>


        $('#exampleModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var recipient = button.data('whatever') // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        modal.find('.modal-title').text('New message to ' + recipient)
        modal.find('.modal-body input').val(recipient)
        })
    </script>
@stop
