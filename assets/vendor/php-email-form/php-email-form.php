<?php
class PHP_Email_Form {

    public $to;
    public $from_name;
    public $from_email;
    public $subject;
    public $smtp = [];
    public $ajax = false;
    private $messages = [];

    public function add_message($content, $label, $priority = 10) {
        $this->messages[] = [
            'label' => $label,
            'content' => $content,
            'priority' => $priority
        ];
    }

    public function send() {
        $message_body = '';

        // Build the message body
        foreach ($this->messages as $message) {
            $message_body .= $message['label'] . ": " . $message['content'] . "\n";
        }

        // Build email headers
        $headers = 'From: ' . $this->from_name . ' <' . $this->from_email . ">\r\n" .
                   'Reply-To: ' . $this->from_email . "\r\n" .
                   'X-Mailer: PHP/' . phpversion();

        // Send the email
        if(mail($this->to, $this->subject, $message_body, $headers)) {
            return 'Message sent successfully!';
        } else {
            return 'Failed to send the message.';
        }
    }
}
?>
