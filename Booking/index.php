<?php

class Booking
{
  private $rejected;
  private $messages;
  private $adult;
  private $children;
  private $infant;
  private $room;
  private $maxRoom;
  private $maxAdultPerRoom;
  private $maxChildrenPerRoom;
  private $maxInfantPerRoom;

  // Initiatise variable on construct
  public function __construct($adult, $children, $infant)
  {
    // Set Reject to false
    $this->rejected = false;
    // Set Max room per booking to 3
    $this->maxRoom = 3;
    // Set Max Adult per room to 3
    $this->maxAdultPerRoom = 3;
    // Set Max Children per room to 3
    $this->maxChildrenPerRoom = 3;
    // Set Max Infant per room to 3
    $this->maxInfantPerRoom = 3;
    // Initiate messages as emmpty array
    $this->messages = [];

    // Set adult input
    $this->adult = $adult;
    // Set children input
    $this->children = $children;
    // Set infant input
    $this->infant = $infant;
    // Set room needed to 0
    $this->room = 0;

    // Valiate max head count
    $this->validateMaxHeadCount();
    // Validate
    $this->validateRoomAllocation();
  }

  private function validateMaxHeadCount() {
    $total = $this->adult + $this->children;
    // Reject if total of adults & children > 7
    if ($total > 7) {
      $this->rejected = true;
      $this->messages[] = 'Exceed max 7 guests (excluding infants)';
    }
  }

  private function validateRoomAllocation() {
    $adultPerRoom = $this->adult / $this->maxAdultPerRoom;
    $childrenPerRoom = $this->children / $this->maxChildrenPerRoom;
    $infantPerRoom = $this->infant / $this->maxInfantPerRoom;

    // At 1 adult per booking
    if ($adultPerRoom == 0) {
      $this->rejected = true;
      $this->messages[] = 'Must have at least 1 adult per room';
    }
    // 1 adult per infant per room
    else if($infantPerRoom > $adultPerRoom) {
      $this->rejected = true;
      $this->messages[] = 'Must have at least 1 adult per infant per room';
    }
    // Max 3 adult or children or infant per 3 room
    else if ($adultPerRoom > $this->maxAdultPerRoom || $childrenPerRoom > $this->maxChildrenPerRoom || $infantPerRoom > $this->maxInfantPerRoom){
      $this->rejected = true;
      $this->messages[] = 'Max 3 adult / children / infant per room';
    }
    // At least 1 adult per room
    else if ($childrenPerRoom > $this->adult) {
      $this->rejected = true;
      $this->messages[] = 'Must have at least 1 adult per infant per room';
    }
    //
    if (!$this->rejected) {
      // set total room to $adultPerRoom
      $this->room = $adultPerRoom;
      // set total room to $childrenPerRoom is greater than
      if ($childrenPerRoom > $this->room) {
        $this->room = $childrenPerRoom;
      }
      // set total room to $infantPerRoom is greater than
      if ($infantPerRoom > $this->room) {
        $this->room = $infantPerRoom;
      }
      if ($this->room > $this->maxRoom) {
        $this->rejected = true;
        $this->messages[] = 'Max 3 room per booking';
      }
    }
  }

  // Return result
  public function result() {
    $room = ceil($this->room);
    return [
      'status' => $this->rejected ? 'danger' : 'success',
      'message' => $this->rejected ? implode('<br />', $this->messages) : "{$this->adult} Adult(s), {$this->children} Children(s) and {$this->infant} Infants can fit in {$room} room(s).",
    ];
  }
}

  if (isset($_POST['adult']) || isset($_POST['children']) || isset($_POST['infant'])) {
    // Get POST parameters
    $adult = isset($_POST['adult']) ? $_POST['adult'] : 0;
    $children = isset($_POST['children']) ? $_POST['children'] : 0;
    $infant = isset($_POST['infant']) ? $_POST['infant'] : 0;

    $booking = new Booking($adult, $children, $infant);
    $result = $booking->result();
  }

?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <title>Hotel Transylvania, Booking</title>
</head>

<body>
  <div class="container">
    <?php if (isset($result)) : ?>
      <div class="alert alert-<?php print $result['status']; ?>">
        <?php print $result['message']; ?>
      </div>
    <?php endif; ?>
    <form action="/index.php" method="post">
      <div class="form-group">
        <label>No. of Adult:</label>
        <select class="form-control" name="adult">
          <?php for ($x = 0; $x <= 10; $x++) : ?>
            <option value="<?php print $x; ?>" <?php if (isset($adult) && $adult == $x): ?> selected <?php endif; ?>>
              <?php print $x; ?>
            </option>
          <?php endfor; ?>
        </select>
      </div>
      <div class="form-group">
        <label>No. of Children:</label>
        <select class="form-control" name="children">
          <?php for ($x = 0; $x <= 10; $x++) : ?>
            <option value="<?php print $x; ?>" <?php if (isset($children) && $children == $x): ?> selected <?php endif; ?>>
              <?php print $x; ?>
            </option>
          <?php endfor; ?>
        </select>
      </div>
      <div class="form-group">
        <label>No. of Infant:</label>
        <select class="form-control" name="infant">
          <?php for ($x = 0; $x <= 10; $x++) : ?>
            <option value="<?php print $x; ?>" <?php if (isset($infant) && $infant == $x): ?> selected <?php endif; ?>>
              <?php print $x; ?>
            </option>
          <?php endfor; ?>
        </select>
      </div>
      <div class="form-group">
        <input type="submit" class="btn btn-success" value="Book!">
  </div>
  </form>
  </div>
</body>

</html>
