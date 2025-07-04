<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use App\Models\CustomField;

class ContactController extends Controller
{
    public function index()
    {
        return view('contacts.list');
    }

    public function store(Request $request)
    {
        $requestData = $request->except('_token');
        $contactId = $request->input('id'); // Hidden input in form for update

        if ($request->hasFile('profile_image')) {
            $profileImagePath = $request->file('profile_image')->store('profile_images', 'public');
            $requestData['profile_image'] = $profileImagePath;
        }

        if ($request->hasFile('additional_file')) {
            $additionalFilePath = $request->file('additional_file')->store('additional_files', 'public');
            $requestData['additional_file'] = $additionalFilePath;
        }

        if ($contactId) {
            $contact = Contact::findOrFail($contactId);
            $contact->update($requestData);

            $contact->customFieldValues()->delete();
            $message = 'Contact updated successfully';
        } else {
            $contact = Contact::create($requestData);
            $message = 'Contact created successfully';
        }

        $names  = $request->input('custom_field_names', []);
        $values = $request->input('custom_field_values', []);

        // Ensure arrays match in count
        if (count($names) === count($values)) {
            for ($i = 0; $i < count($names); $i++) {
                $fieldName = trim($names[$i]);
                $fieldValue = $values[$i];

                if ($fieldName !== '') {
                    $slug = Str::slug($fieldName);

                    // Create or fetch custom field
                    $customField = CustomField::firstOrCreate(
                        ['field_name_slug' => $slug],
                        ['field_name' => $fieldName, 'field_type' => 'text'] // default type
                    );

                    // Create field value for contact
                    $contact->customFieldValues()->create([
                        'custom_field_id' => $customField->id,
                        'value'           => $fieldValue,
                    ]);
                }
            }
        }
        return response()->json([
            'success'  => true,
            'message' => $message ?? 'Contact created successfully'
        ]);
    }

    public function update(ContactRequest $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

    public function getContactData(Request $request)
    {
        $requestData = $request->except('_token');
        // Get page & pageSize from request
        $page = $requestData['page'] ?? 1;
        $pageSize = $requestData['pageSize'] ?? 15;
        $filters = $requestData['filters'] ?? [];

        $search = [];
        foreach($filters as $key => $value){
            if($value != ''){
                if (in_array($key, ['name', 'email'])) {
                    $search[$key] = '%' . $value . '%';
                } elseif ($key === 'gender') {
                    $search[$key] = $value;
                }
            }
        }
        $paginate = [
            'limit' => $pageSize,
            'offset' => (($page-1)* $pageSize),
        ];
        $data = Contact::fetchList($search ?? [], [], $paginate);

        // Total records count (optional)
        // $total = Contact::whereNull('merged_into')->count();
        $total = Contact::count();

        // Return JSON response
        return response()->json([
            'data'  => $data,
            'total' => $total
        ]);
    }

    public function addConatctForm()
    {
        return view('contacts.add');
    }


}
