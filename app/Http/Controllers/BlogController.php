<?php

namespace App\Http\Controllers;

use App\BlogModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BlogController extends Controller
{
    public $myBlogs = [
        [
            "index"=> 0,
            "title"=>"Novice to Knowledge",
            "description"=>"A story how I get into programming",
            "image" =>"assets/blog1.jpg",
            "content" => " In 2017, I started my programming journey in the K-12 program's ICT strand. I quickly developed a passion for programming after learning C++ and working on a Room Utilization system using VB6 and Microsoft Access during my internship. In Grades 11 and 12, I ranked first in the ICT strand, earning recognition and the title of Most Outstanding ICT Student.
            In college, I focused on C# and VB.net, showcasing my skills through a Police Clearance system and a 2D endless runner game called Jump Ninja, created with the Unity game engine. I also expanded into web development, mastering HTML5, CSS3, JavaScript, PHP, MySQL, Bootstrap, Tailwind CSS, and various libraries. My first freelance project was a Freelance Marketplace for a student from the University of San Agustin.
            During the CAPSTONE Development phase, I gained expertise in Content Management Systems (CMS) and created an Ecommerce website for Barbie Sweet Little Things Shop. Throughout college, I consistently earned a spot on the Dean's List and anticipate graduating cum laude, reflecting my dedication and pursuit of excellence."
        ],
        [
            "index"=> 1,
            "title"=>"SAWI@TechnoPOS",
            "description"=>"A story about my internship",
            "image" =>"assets/blog2.jpg",
            "content" => "The orientation session was a great opportunity for me to learn more about 
            the company and my role within it. During the session, we began by discussing the 
            company profile, which included its history, mission, and values. I found this 
            information to be particularly valuable in understanding the company's culture and 
            vision for the future.
            As an intern at TechnoPOS Computer Store was an exciting experience. 
            Upon arrival, I was introduced to the team and given a task by Mrs. Binuya. Mrs. 
            5
            Binuya tasked me with developing a website for AffordaPOS, a website for their 
            company to expand their online presence. As soon as I received the task, I began 
            brainstorming ideas for the website's design. I wanted to create a website that was 
            not only visually appealing but also user-friendly and accessible. To achieve this, 
            I conducted extensive research on the latest web design trends, analyzed 
            competitor websites.
            I spent hours poring over various web design resources and seeking 
            inspiration for the website's layout, color scheme, and overall aesthetic. I also kept 
            in mind AffordaPOS's branding and visual identity to ensure that the website 
            aligned with their overall image and message.
            During my internship I create a visually stunning and engaging website. I 
            used my knowledge in HTML5, CSS3, Vanilla JS and other libraries to create 
            website. I worked tirelessly to ensure that the it was responsive across different 
            devices and screen sizes, using media queries and flexible layout techniques to 
            ensure that the hero section looked great on everything from large desktop 
            monitors to small mobile phones.
            I also had the opportunity to collaborate with Renz John Sagge, to enhance 
            and refine the website further. Our collaboration was a smooth and seamless 
            process, and we held several meetings using Gmeet to discuss our ideas and 
            coordinate our efforts effectively.
            Besides of website development, I also experience at TechnoPOS 
            Computer Store to performed Quality Assurance Testing on the company's product 
            (point-of-sale (POS) system and hardware). This is a crucial step in our efforts to 
            6
            improve the company's services and maintain commitment to providing high-quality products to customer"
        ]
    ];

    public function index() {
        $myBlogs = BlogModel::all();
        return view('template.indexTemplate')
            ->with(['myBlogs' => $myBlogs]);
            
    }

    public function about() {
        return view('template.aboutTemplate');
    }

    public function blog($index) {
        if (array_key_exists($index, $this->myBlogs)) {
            $blogs = $this->myBlogs[$index];
            return view('template.blogTemplate')
                ->with(['blogs' => $blogs]);
        } else {
            return redirect('404');
        }
    }

    public function upload(Request $request) {
        $validated = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'comment' => 'required|min:6|max:50'
        ]);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
        } else {
            $imageName = null;
        }
        
        $comment = $validated['comment'];
    
        return redirect()->back()->with([
            'comments' => [
                'comment' => $comment,
                'image' => $imageName
            ]
        ]);
    }

    public function delete($image) {
        $imagePath = public_path('images/' . $image);
        if (File::exists($imagePath)) {
            File::delete($imagePath);
            return redirect()->back()->with('messageDel', 'Delete Success');
        } else {
            return redirect()->back()->with('messageDel', 'Delete failed');
        }
    }
}
