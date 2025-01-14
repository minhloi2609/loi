<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Validation\Rule;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function index()
    {
        // Trả về view giao diện tài khoản
        return view('account.edit_profile');
    }

    public function updateProfile(Request $request)
    {
        // Lấy người dùng hiện tại
        $user = Auth::user();

        // Xác thực các trường form
        // $request->validate([
        //     'full_name' => 'required|string|max:255',
        //     'email' => [
        //         'required',
        //         'email',
        //         'max:255',
        //         Rule::unique('users')->ignore($user->id), // Sử dụng Rule::unique
        //     ],
        //     'address' => 'required|string|max:255',
        //     'phone_number' => 'required|string|max:15',
        //     'image_user' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        // ]);
        $emailRules = ['required', 'email', 'max:255'];

        if ($request->input('email') !== $user->email) {
            $emailRules[] = Rule::unique('users')->ignore($user->id);
        }

        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => $emailRules,
            'address' => 'required|string|max:255',
            'phone_number' => 'required|string|max:15',
            'image_user' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        // Dữ liệu cần cập nhật
        $updateData = [
            'full_name' => $request->input('full_name'),
            'email' => $request->input('email'),
            'address' => $request->input('address'),
            'phone_number' => $request->input('phone_number'),
        ];
        // Nếu có ảnh được upload
        if ($request->hasFile('image_user')) {
            // Xóa ảnh cũ nếu có
            if ($user->image_user) {
                if ($user->image_user) {
                    // Đường dẫn tệp cũ
                    $oldImagePath = public_path('storage/' . $user->image_user);
                    // Kiểm tra xem tệp có tồn tại không
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath); // Xóa tệp
                    } else {
                        // \Log::info("File does not exist: " . $oldImagePath); // Ghi log nếu không tìm thấy tệp
                    }
                }
            }
            // Tạo tên file với định dạng 'user' + thời gian + phần mở rộng
            $imageName = 'user' . time() . '.' . $request->file('image_user')->extension();
            // Lưu file vào thư mục 'image_users' với tên tùy chỉnh
            $image_userPath = $request->file('image_user')->storeAs('image_users', $imageName, 'public');
            // Thêm đường dẫn ảnh vào dữ liệu cập nhật
            $updateData['image_user'] = $image_userPath;
        }



        // Cập nhật thông tin người dùng
        DB::table('users')->where('user_id', $user->user_id)->update($updateData);

        // Chuyển hướng với thông báo thành công
        return redirect()->back()->with('success', 'Profile updated successfully!');
    }
}
