<?php
class FsStacksComments extends BaseFsStacksComments
{
  var $userObject;
  
  public function fetchUserObject()
  {
    $user_criteria = new Criteria();
    $user_criteria->add(sfGuardUserPeer::ID, $this->getUserId(), Criteria::EQUAL);
    $this->userObject = sfGuardUserPeer::doSelectOne($user_criteria);
  }
  
  /**
   * Gets the amount of time since the stack was made in words
   *
   * @return integer
   */
  public function getTimeSince()
  {
    $stacked_date = new Date($this->getCreatedAt());
    $current_date = new Date();

    $span = new Date_Span();
    $span->setFromDateDiff($stacked_date, $current_date);
    if ($span->toDays() >= 7) {
      $span_parts = explode('.', $span->toDays());
      $span_parts[0] = $span_parts[0]/7;
      if ($span_parts[0] == 1) {
        return $span_parts[0].' week';
      }
      else {
        return $span_parts[0].' weeks';
      }
    }
    else if ($span->toDays() >= 1) {
      $span_parts = explode('.', $span->toDays());
      if ($span_parts[0] == 1) {
        return $span_parts[0].' day';
      }
      else {
        return $span_parts[0].' days';
      }
    }
    else if ($span->toHours() >= 1) {
      $span_parts = explode('.', $span->toHours());
      if ($span_parts[0] == 1) {
        return $span_parts[0].' hour';
      }
      else {
        return $span_parts[0].' hours';
      }
    }
    else if ($span->toMinutes() >= 1) {
      $span_parts = explode('.', $span->toMinutes());
      if ($span_parts[0] == 1) {
        return $span_parts[0].' minute';
      }
      else {
        return $span_parts[0].' minutes';
      }
    }
    else if ($span->toSeconds() >= 1) {
      $span_parts = explode('.', $span->toSeconds());
      if ($span_parts[0] == 1) {
        return $span_parts[0].' second';
      }
      else {
        return $span_parts[0].' seconds';
      }
    }
  }
}
