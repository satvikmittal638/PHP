<div class="modal fade" id="addQuizModal" tabindex="-" aria-labelledby="addQuizModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addQuizModalLabel">Add a new quiz</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="partials/_handleAddQuiz.php">
                <div class="modal-body">
                    <input type="hidden" name="assignedBy" value="<?php echo  $_SESSION['admin']['id']?>">
                    <input type="hidden" name="subject" value="<?php echo $_SESSION['admin']['subject']?>">

                    <div class="mb-3">
                        <input type="text" name="quizName" class="form-control" id="inpQuizName"
                            placeholder="Name of Quiz">
                    </div>

                    <div class="mb-3">
                        <label for="inpStartDate" class="form-label">Start Date</label>
                        <input type="date" name="startDate" id="inpStartDate">
                        <label for="inpStartTime" class="form-label">Start Time</label>
                        <input type="time" name="startTime" id="inpStartTime">
                    </div>

                    <div class="mb-3">
                        <label for="inpEndDate" class="form-label">End Date</label>
                        <input type="date" name="endDate" id="inpEndDate">

                        <label for="inpEndTime" class="form-label">End Time</label>
                        <input type="time" name="endTime" id="inpEndTime">
                    </div>

                    <div class="mb-3">
                        <input type="number" name="maxMarks" class="form-control" id="inpMaxMarks"
                            placeholder="Maximum Marks">
                    </div>

                    <div class="mb-3">
                        <input type="number" name="durationInMin" class="form-control" id="inpDuration"
                            placeholder="Duration">
                    </div>
                    <div class="mb-3">
                        <label for="inpInstructions" class="form-label">Instructions</label>
                        <textarea class="form-control" name="instructions" id="inpInstructions" rows="2"></textarea>
                    </div>

                    <div class="mb-3">
                        <input type="number" name="schoolClass" class="form-control" id="inpClass"
                            placeholder="Class to assign to" max=12>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Create Quiz</button>
                </div>
            </form>
        </div>
    </div>
</div>