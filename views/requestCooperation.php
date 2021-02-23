            <div class="container">
                <!-- Forma -->
                <br><br>
                <form name="coopForm" action="<?php echo site_url($controller.'/sendCoopRequest') ?>" method="post">
                    <h2>Enter the required information:</h2><br>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Exact date and time of performance you're scheduling:</label>
                        <input type="datetime-local" class="form-control" id="exampleFormControlInput1" name="Date">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">In a few sentences describe details of your cooperation with the other party:</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" name="Description"></textarea>
                    </div>
                    <input type="hidden" name="userWhich" value="<?php echo $user->Username?>">
                    <input class="btn btn-primary btn-lg" type="submit" value="Request">
                </form>
            </div>
