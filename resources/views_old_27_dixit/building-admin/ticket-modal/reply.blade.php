<!-- Modal HTML -->
<div id="myModal" class="modal-overlay" style="display: none;">
    <div class="modal-content">
        <span class="modal-close" onclick="closeModal()">&times;</span>
        <div id="editor">
            <div id="quillEditor" style="height: 300px;"></div>
        </div>
    </div>
</div>

<style>
/* Modal Overlay */
.modal-overlay {
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
}

/* Modal Content */
.modal-content {
    background-color: #ffffff;
    padding: 20px;
    border-radius: 8px;
    width: 500px;
    text-align: center;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    position: relative;
}

/* Close Button */
.modal-close {
    color: #aaa;
    font-size: 28px;
    font-weight: bold;
    position: absolute;
    top: 5px;
    right: 3px;
    cursor: pointer;
}

.modal-close:hover, .modal-close:focus {
    color: black;
}
</style>

<!-- Quill Editor CSS -->
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script>
   let quill;

function openModal() {
    document.getElementById("myModal").style.display = "flex";

    // Only initialize Quill if it hasn't been initialized yet
    if (!quill) {
        quill = new Quill('#quillEditor', {
            theme: 'snow',
            modules: {
                toolbar: [
                    [{ 'header': [1, 2, false] }],
                    ['bold', 'italic', 'underline'],
                    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                    ['link', 'image'],
                    ['clean']
                ]
            }
        });
    }
}

function closeModal() {
    document.getElementById("myModal").style.display = "none";
    // Optional: you can get the HTML content when closing the modal
    const content = quill.root.innerHTML;
    console.log(content); // Log or handle the content as needed
}

window.onclick = function(event) {
    var modal = document.getElementById("myModal");
    if (event.target == modal) {
        modal.style.display = "none";
        // Optional: you can get the HTML content when closing by clicking outside
        const content = quill.root.innerHTML;
        console.log(content); // Log or handle the content as needed
    }
}

function checkAndOpenModal() {
    var shouldOpen = false; // Change this condition based on your needs

    if (shouldOpen) {
        openModal();
    }
}

window.onload = checkAndOpenModal;

</script>
