@extends('includes.layout')
@section('content')
    
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <div class="mt-5">
                        <h4 class="card-title float-left mt-2">Contact List</h4>
                        <button class="btn btn-primary float-right openAddPopUpBtn">Create Contact</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-table">
                    <div class="card-body booking_card">
                        <div class="table-responsive">
                            <table id="contactTable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div id="contactPopup" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-3">
            <div class="modal-header">
                <h5 class="modal-title">Add Contact</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body contact-add">



            </div>
        </div>
    </div>
</div>

@push('custom-scripts')
<script>
    $(document).ready(function () {
        
        new DataTable('#contactTable', {
            ajax: '{{ route("contacts.get-data") }}',
            columns: [
                { data: 'id' },
                { data: 'name' },
                { data: 'email' },
                { data: 'phone' },
                {
                    data: null,
                    orderable: false,
                    searchable: false,
                    render: function (data, type, row) {
                        return `
                            <button class="btn btn-sm btn-info">Edit</button>
                            <button class="btn btn-sm btn-danger">Delete</button>
                        `;
                    }
                }
            ],
            responsive: true,
            language: {
                search: '_INPUT_',
                searchPlaceholder: 'Search contacts...'
            }
        });
        
        $('body').on('click', '.openAddPopUpBtn', function(){
            $.ajax({
                url: '{{ route("contacts.add-form") }}',
                method: 'GET',
                success: function (response) {
                    $('.contact-add').html(response);
                    $('#contactPopup').modal('show');
                }
            });
        });

        $('body').on('submit', '#contactForm', function(e) {
            e.preventDefault();
            var form = $('#contactForm')[0];
            var formData = new FormData(form);
            $.ajax({
                url: "{{ route('contacts.store') }}",
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(res) {
                    var error_msg = '';
                    if (res && res.success) {
                        $('#contactPopup').modal('hide');
                        notification('success', res.message);
                        loading = false;
                        hasMoreData = true;
                        selectedContacts = [];
                        page = 1;
                        $('.btn-merge-selected').attr('disabled', true);
                        $('.btn-delete-selected').attr('disabled', true);
                        $('.contacts-ul-li').html('');
                        loadContacts(true);
                    } else {
                        $('.err_').html('');
                        $.each(res.message, function(key, value) {
                            key = key.replaceAll('.', '_');
                            $('.' + key + '-error').html('<p>' + value[0] +
                                '</p>');
                            error_msg += value[0] + '</br>';
                        });
                        notification('error', res.message);
                    }
                },
                error: function(xhr) {
                    $('.text-danger').html('');

                    if (xhr.status === 422) {
                        let response = xhr.responseJSON;

                        if (response && response.errors) {
                            $.each(response.errors, function(key, messages) {
                                let safeKey = key.replace(/\./g, '_'); // convert dot notation
                                $('.' + safeKey + '-error').html('<strong>' + messages[0] + '</strong>');
                            });
                        }
                    } else {
                        alert("Something went wrong. Please try again.");
                    }
                }
            });
        });
    });
</script>
@endpush
@stop