<!-- Modal HTML -->
<div id="myModal_1" class="modal-overlay" style="display: none;">
    <div class="modal-content_1">
        <span class="modal-close" onclick="closeModal_1()">&times;</span>
        <h2><strong>Description</strong></h2>
        <p>Like most people, you probably take formal classes to learn English. However, there are plenty of other ways to learn and practice.
        </p>
        <p>Like most people, you probably take formal classes to learn English. However, there are plenty of other ways to learn and practice.
        </p>
        <p>Like most people, you probably take formal classes to learn English. However, there are plenty of other ways to learn and practice.
        </p>
    </div>
     </div>
</div>

<style>
/* Modal Overlay */
.modal-overlay {
    position: fixed;
    z-index: 1000; /* High z-index to ensure it sits on top */
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
}

/* Modal Content */
.modal-content_1 {
    background-color: #ffffff;
    padding: 20px;
    border-radius: 8px;
    width: 500px; /* Increase the width here */
    text-align: center;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    position: relative; /* Ensures close button positioning is relative to modal */
}


/* Close Button */
.modal-close {
    color: #aaa;
    font-size: 28px;
    font-weight: bold;
    position: absolute;
    top: 10px;
    right: 10px;
    cursor: pointer;
}

.modal-close:hover, .modal-close:focus {
    color: black;
}

.form-group {
    display: flex;
    flex-direction: column; /* Keeps items stacked vertically */
}

.form-group-item {
    display: flex;
    align-items: center; /* Centers items vertically */
    margin-bottom: 1rem; /* Space between fields */
}

.form-group-item label {
    width: 30%; /* Adjust as needed for label width */
    margin-right: 1rem; /* Space between label and input */
    text-align: right; /* Aligns text to the right within the label */
    font-weight: bold;
}

.form-group-item input {
    width: 70%; /* Adjust as needed to fill the remaining space */
    padding: 0.5rem; /* Add padding for better usability */
    border-radius: 4px; /* Rounded corners for input */
    border: 1px solid #ddd; /* Border style for input */
}

.text-red {
    color: red;
}


</style>

<script>
    function openModal_1() {
        document.getElementById("myModal_1").style.display = "flex";
    }

    function closeModal_1() {
        document.getElementById("myModal_1").style.display = "none";
    }

    window.onclick = function(event) {
        var modal = document.getElementById("myModal_1");
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

    // Example function to open modal
    function checkAndOpenModal() {
        // Add your condition here
        var shouldOpen = false; // Change this condition based on your needs

        if (shouldOpen) {
            openModal_1();
        }
    }

    window.onload = checkAndOpenModal;
</script>
