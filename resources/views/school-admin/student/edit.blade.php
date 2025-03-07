<x-layout.default>
    <div class="relative flex min-h-screen items-center justify-center bg-[url(/assets/images/auth/map.png)] bg-cover bg-center bg-no-repeat px-6 py-10 dark:bg-[#060818] sm:px-16">

    <div class="panel shadow-lg rounded-lg p-8 max-w-6xl mx-auto " style="border-color: #a8acaf; border-width: medium;">
        <div class="flex justify-center mb-4">
            <h1 class="text-2xl font-bold">Edit Student</h1>
        </div>
       

        <form method="POST" action="{{route('school.student.update', $value->id )}}">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label for="name"><strong>Name</strong></label>
                    <input id="name" type="text" name="name" value="{{ $value->name}}" placeholder="Enter Name" class="form-input" required />
                </div>
                <div>
                    <label for="middle"><strong>Middle Name</strong></label>
                    <input id="middle" name="middle" type="text" value="{{ $value->middle}}" placeholder="Enter Middle Name" class="form-input" required />
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label for="last"><strong>Last Name</strong></label>
                    <input id="last" name="last" type="text" value="{{ $value->last}}" placeholder="Enter Last Name" class="form-input" required />
                </div>
                <div>
                    <label for="email"><strong>Email ID</strong></label>
                    <div class="flex">
                        <div class="bg-[#eee] flex justify-center items-center ltr:rounded-l-md rtl:rounded-r-md px-3 font-semibold border ltr:border-r-0 rtl:border-l-0 border-[#e0e6ed] dark:border-[#17263c] dark:bg-[#1b2e4b]">@</div>
                        <input id="email" type="email" name="email" value="{{ $value->email}}" placeholder="Enter Email" class="form-input ltr:rounded-l-none rtl:rounded-r-none" required />
                    </div>
                </div>
            </div>  
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label for="class"><strong>Class</strong></label>
                    <input id="class" type="number" name="class" value="{{ $value->class}}" placeholder="Enter Class" class="form-input" required />
                </div>
                <div>
                    <label for="section"><strong>Section</strong></label>
                    <input id="section" name="section" type="text" value="{{ $value->section}}" placeholder="Enter Section" class="form-input" required />
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label for="mobile"><strong>Mobile</strong></label>
                    <input id="mobile" type="number" name="mobile" value="{{ $value->mobile}}" placeholder="Enter Mobile" class="form-input" required />
                </div>
                <div>
                    <label for="whatsapp"><strong>WhatsApp</strong></label>
                    <input id="whatsapp" name="whatsapp" type="number" value="{{ $value->whatsapp}}" placeholder="Enter Whatsapp" class="form-input" required />
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label for="student_id"><strong>Student ID</strong></label>
                    <input id="student_id" type="text" name="student_id" value="{{ $value->student_id}}" placeholder="Enter student id" class="form-input" required />
                </div>
                <div>
                    <label for="guardian"><strong>Guardian Name</strong></label>
                    <input id="guardian" name="guardian" type="text" value="{{ $value->guardian}}" placeholder="Enter Guardian Name" class="form-input" required />
                </div>
            </div>
                                  
           
            <!-- Submit Button -->
            <div>
                <button type="submit" class="btn btn-primary !mt-6">Update</button>
            </div>
        </form>

    </div>
    </div>
    

    </x-layout.default>