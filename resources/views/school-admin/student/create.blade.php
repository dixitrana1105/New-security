<x-layout.default>
    <div class="relative flex min-h-screen items-center justify-center bg-[url(/assets/images/auth/map.png)] bg-cover bg-center bg-no-repeat px-6 py-10 dark:bg-[#060818] sm:px-16">  
        <div class="panel shadow-lg rounded-lg p-8 max-w-6xl mx-auto" style="border-color: #a8acaf; border-width: medium;">
            <form action="{{ route('upload.csv') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div>
            <input accept=".csv, .xls, .xlsx" name="file" class="input-hidden" type="file" />
            </div>
            <br>
            <div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            </form>
        </div>        
    </div>          
</x-layout.default>
    
    