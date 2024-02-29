<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdatePhotoRequest;
use App\Http\Requests\createProfileRequest;

class CustomerController extends Controller
{
    public function createProfile(createProfileRequest $request){
        if($request->hasFile('image')){
                     $file=$request->file('image');
       $url = Storage::disk('public')->putFile('profile', $file);
       $size = $file->getSize();
                 $customer = new Customer();
                     $customer->join_at=$request->join_at;
                     $customer->user_id=$request->user_id;
                     $customer->image=$url;
                     $customer->save();
                         }
                        //  return $customer;
                         return response()->json([
                            'customer' => $customer,
                            'message' => "Customer Create His Profile Successfully."
                        ], 200);


 }
 public function updatePassword(Request $request,$id){
     $user = User::find($id);
     $user->password = Hash::make($request->password);
     $user->save();
    //  return $user;
     return response()->json([
        'user' => $user,
        'message' => "User Update His Password Successfully."
    ], 200);

}


         public function updateProfile(CreateProfileRequest $request, $id)
 {
     $user = User::find($id);

     if ($request->hasFile('image')) {
         $Customer = Customer::findOrFail($id);
         if ($Customer->image) {
             Storage::disk('public')->delete($Customer->image);
         }
         $file = $request->file('image');
         $url = Storage::disk('public')->putFile('profile', $file);
         $size = $file->getSize();
         $Customer->join_at = $request->join_at;
         $Customer->user_id = $request->user_id;
         $Customer->image = $url;
         $Customer->save();
        //  return $Customer;
         return response()->json([
            'Customer' =>  $Customer,
            'message' => "Customer Update His Profile Successfully."
        ], 200);
     }else {
        return response()->json(['message' => 'No image file uploaded.'], 400);
    }
     }

     public function updateProfilePhoto(UpdatePhotoRequest $request,$id){
         $user = User::find($id);
         if (!$user) {
            return response()->json(['message' => 'User not found.'], 404);
        }
         if ($request->hasFile('image')) {
             $Customer = Customer::findOrFail($id);
             if ($Customer->image) {
                 Storage::disk('public')->delete($Customer->image);
             }
             $file = $request->file('image');
             $url = Storage::disk('public')->putFile('profile', $file);
             $size = $file->getSize();
             $Customer->user_id = $request->user_id;
             $Customer->image = $url;
             $Customer->save();
            //  return $Customer;
             return response()->json([
                'Customer' =>  $Customer,
                'message' => "Customer Update His Profile Photo Successfully."
            ], 200);
        } else {
            return response()->json(['message' => 'No image file uploaded.'], 400);
        }
     }


     public function checkHistoryMovie(Request $request,$id){
         $user = User::find($id);
         $user->movies()->attach($request->movie_id);
         return $user->movies;
 }


     public function clearHistoryMovie(Request $request,$id){
         $user = User::find($id);
         $user->movies()->detach();
         return $user->movies;
     }

     public function deleteSingleHistoryMovie(Request $request, $id ,$movie_id){
     $user = User::find($id);
     $user->movies()->detach($movie_id);
     return $user->movies;

 }
     public function showAllCategories(){
         // $categories = Category::with('subcategories')->whereNull('parent_id')->get();
         $categories = Category::all();
         return $categories;
     }
     public function searchAMovieByCategoryId(Request $request,$id){
             $category = Category::find($id);
             $movie = $category->movies;
             return $movie;
         }

         public function searchAMoviePaidOrFree(Request $request){
             $movies = Movie::all();
             return $movies;
         }


         public function addReviewForMovie(Request $request,$id){
             $movie = Movie::find($id);
             $review = new Review([
                 'stars' => $request->stars,
                 'status' => $request->status,
                 'comment' => $request->comment,
                 'user_id' => $request->user_id,
                 'movie_id' => $request->movie_id,
             ]);
             $review->save();
             return $review;

         }
         public function editReview($id){
             $review = Review::find($id);
             return $review;
         }

         public function deleteReview($id){
             $review = Review::findOrFail($id);
             $review->delete();
         }

         public function showMovieDetail($id){
         $movie = Movie::findOrFail($id);
         // $reviews = Review::where('movie_id', $id)->get();
         // $reviews = $movie->reviews;
         // $recommendedMovies = $movie->categories()
         // ->movies()
         // ->where('movies.id', '!=', $id)
         // ->take(5)
         // ->get();
         return $movie;
     }

         public function watchOnlyFree(Request $request){
             $customerId = $request->user()->id;

             $movies = $this->getMoviesForUser($customerId);

             return response()->json(['movies' => $movies]);
         }

         private function getMoviesForUser($customerId)
         {
             $user = User::find($customerId);
             $movies = $user->isPaid() ? Movie::all() : Movie::where('isFree', true)->get();
             return $movies;
         }
}
