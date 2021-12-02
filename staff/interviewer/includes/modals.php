<!-- Modal For Add Exam -->
<div class="modal fade" id="addExamModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
   <form action="be/manage-exam/addExam.php" method="post" enctype="multipart/form-data">
     <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Exam</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="col-md-12">

          <div class="form-group">
            <label>Exam Time Limit</label>
            <div class="form-line">
            <select class="form-control" name="timeLimit" required="">
              <option value="0">Select time</option>
              <option value="10">10 Minutes</option> 
              <option value="20">20 Minutes</option> 
              <option value="30">30 Minutes</option> 
              <option value="40">40 Minutes</option> 
              <option value="50">50 Minutes</option> 
              <option value="60">60 Minutes</option> 
            </select>
          </div>
          </div>

          <div class="form-group">
            <label>Question Limit to Display</label>
            <div class="form-line">
            <input type="number" name="questionLimit" id="" class="form-control" placeholder="Input question limit to display">
          </div>
          </div>

          <div class="form-group">
            <label>Exam Title</label>
            <div class="form-line">
                <input type="" name="examTitle" class="form-control" placeholder="Input Exam Title" required="">
            </div>
          </div>

          <div class="form-group">
            <div class="form-line">
            <label>Exam Description</label>
            <textarea name="examDesc" class="form-control" rows="4" placeholder="Input Exam Description" required=""></textarea>
          </div>
        </div>


        </div>
      </div>
       <div class="modal-footer">
            <button type="submit" class="btn btn-link waves-effect" name="addExam" id="addExam">SAVE CHANGES</button> 
            <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
        </div>
    </div>
   </form>
  </div>
</div>