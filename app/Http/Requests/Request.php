<?php namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Http\Exceptions\HttpResponseException;

class Request extends FormRequest {
  /**
   * @param Validator $validator
   * @return array
   */
  protected function formatErrors(Validator $validator) {
    $errors = $validator->errors()->getMessages();
    $transformed = [];

    foreach ($errors as $field => $messages) {
      $transformed[$field] = $messages[0];
    }

    return $transformed;
  }

  protected function failedValidation(Validator $validator)
  {
    $errors = $validator->errors()->getMessages();
    $transformed = [];

    foreach ($errors as $field => $messages) {
      $transformed[$field] = $messages[0];
    }

    throw new HttpResponseException($this->error_message($transformed));
  }

  public function error_message($errors) {
    return response()->json([
      'status'  => false,
      'message' => '<ul><li>' . implode('</li><li>', $errors) . '</li></ul>',
      'errors' => $errors
    ], 422);
  }
}