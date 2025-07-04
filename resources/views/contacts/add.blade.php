<form id="contactForm" class="needs-validation" enctype="multipart/form-data" method="POST">
@csrf
@if(isset($contact) && (!empty($contact)))
    {{-- @method('PUT') --}}
    <input type="hidden" name="id" value="{{ $contact->id ?? '' }}">
@endif

<div class="mb-3">
    <label class="form-label">Name</label>
    <input type="text" name="name" class="form-control" value="{{ $contact->name ?? '' }}">
    <div class="text-danger name-error"></div>
</div>

<div class="mb-3">
    <label for="email" class="form-label">Email</label>
    <input type="email" class="form-control" name="email" id="email" value="{{ $contact->email ?? '' }}">
    <div class="invalid-feedback">Please enter a valid email.</div>
    <div class="text-danger email-error"></div>
</div>

<div class="mb-3">
    <label for="phone" class="form-label">Phone</label>
    <input type="tel" class="form-control" name="phone" id="phone" value="{{ $contact->phone ?? '' }}">
    <div class="text-danger phone-error"></div>
</div>

<div class="mb-3">
    <label class="form-label">Gender</label><br>
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="gender" value="Male" @if((isset($contact) && (!empty($contact))) && (($contact->gender == 'Male') || ($contact->gender == 'Male'))) checked @endif>
        <label class="form-check-label">Male</label>
    </div>
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="gender" value="Female" @if((isset($contact) && (!empty($contact))) && ($contact->gender == 'Female')) checked @endif>
        <label class="form-check-label">Female</label>
    </div>
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="gender" value="Other" @if((isset($contact) && (!empty($contact))) && ($contact->gender == 'Other')) checked @endif>
        <label class="form-check-label">Other</label>
    </div>
    <div class="text-danger gender-error"></div>
</div>

<div class="mb-3">
    <label for="profile_image" class="form-label">Profile Image</label>
    <input class="form-control" type="file" name="profile_image" id="profile_image" accept="image/*">
    <div class="text-danger profile_image-error"></div>
</div>

<div class="mb-3">
    <label for="additional_file" class="form-label">Additional File</label>
    <input class="form-control" type="file" name="additional_file" id="additional_file">
    <div class="text-danger additional_file-error"></div>
</div>

<div class="mb-3">
    <label class="form-label">Custom Fields</label>
    <div id="custom-fields-container">
        @if(isset($customFields) && (!empty($customFields)))
        @foreach ($customFields as $field)
            <div class="input-group mb-2 custom-field-row">
                <input type="text" class="form-control" name="custom_field_names[]" value="{{ $field['name'] }}" placeholder="Field name (e.g. Birthday)">
                <input type="text" class="form-control" name="custom_field_values[]" value="{{ $field['value'] }}" placeholder="Field value (e.g. 1990-01-01)">
                <button type="button" class="btn btn-outline-danger" onclick="removeCustomField(this)">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>
        @endforeach
        @endif
    </div>
    <div class="text-danger custom_fields-error"></div> <!-- optional catch-all -->
    <button type="button" class="btn btn-sm btn-outline-secondary mt-2" onclick="addCustomField()">+ Add Field</button>
</div>

<div class="text-end">
    <button type="submit" class="btn btn-primary">{{ (isset($contact) && (!empty($contact))) ? 'Update' : 'Save' }}</button>
</div>
</form>

