<?php
/*
 * Copyright 2013 Christian Fillion
 *
 * MIT LICENSE
 *
 * Permission is hereby granted, free of charge, to any person obtaining
 * a copy of this software and associated documentation files (the
 * "Software"), to deal in the Software without restriction, including
 * without limitation the rights to use, copy, modify, merge, publish,
 * distribute, sublicense, and/or sell copies of the Software, and to
 * permit persons to whom the Software is furnished to do so, subject to
 * the following conditions:
 *
 * The above copyright notice and this permission notice shall be
 * included in all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
 * EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
 * MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
 * NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE
 * LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION
 * OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION
 * WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */

class FastMailBuilder
{
	const CHUNKLEN = 76;

	const MULTIPART = 11;
	const ATTACHMENTS = 12;
	const CUSTOM = 13;

	const SEPARATED = 21;
	const ONESHOT = 22;

	protected $state;
	protected $boundary;
	protected $partBoundary;

	protected $nl = "\r\n";
	protected $sendMode = self::SEPARATED;

	protected $sendList = array();
	protected $ccList = array();
	protected $bccList = array();
	protected $from;
	protected $fromEmail;
	protected $sender;
	protected $replyTo;
	protected $readReceipt;
	protected $subject;
	protected $body;
	protected $customHeaders = array();

	/**
	 * @param string $prefix nothing useful
	 */
	public function __construct($prefix = '=')
	{
		$this->boundary = $prefix . sha1(uniqid(mt_rand(), true));
		$this->partBoundary = 'part_' . sha1(uniqid(mt_rand(), true));
	}

	/**
	 * Encode a string to be used as a header value
	 * @param  string $string
	 * @return string
	 */
	protected function encodeWord($string)
	{
		return '=?UTF-8?B?'.base64_encode($string).'?=';
	}

	/**
	 * Return the smail sending mode
	 * @return int
	 */
	public function getSendMode()
	{
		return $this->sendMode;
	}

	/**
	 * Set the email sending mode
	 * @param int $newMode
	 */
	public function setSendMode($newMode)
	{
		$this->sendMode = $newMode;
	}

	/**
	 * Add a recipient
	 * @param  string $name  Recipient name. This parameter is optional.
	 * @param  string $email Recipient email.
	 * @return FastMailBuilder $this
	 */
	public function to($name, $email = null)
	{
		$formatted = $email === null ? $name : '"' . $this->encodeWord($name)  .'" <' . $email . '>';

		if(!in_array($formatted, $this->sendList))
			$this->sendList[] = $formatted;

		return $this;
	}

	/**
	 * Return the formatted recipient list
	 * @return array
	 */
	public function getRecipients()
	{
		return $this->sendList;
	}

	/**
	 * Add a carbon copy recipient
	 * @param  string $name  Recipient name. This parameter is optional.
	 * @param  string $email Recipient email.
	 * @return FastMailBuilder $this
	 */
	public function cc($name, $email = null)
	{
		$formatted = $email === null ? $name : '"' . $this->encodeWord($name)  .'" <' . $email . '>';

		if(!in_array($formatted, $this->ccList))
			$this->ccList[] = $formatted;

		return $this;
	}

	/**
	 * Return the formatted carbon copy recipient list
	 * @return array
	 */
	public function getCcRecipients()
	{
		return $this->ccList;
	}

	/**
	 * Add a blind carbon copy recipient
	 * @param  string $name  Recipient name. This parameter is optional.
	 * @param  string $email Recipient email.
	 * @return FastMailBuilder $this
	 */
	public function bcc($name, $email = null)
	{
		$formatted = $email === null ? $name : '"' . $this->encodeWord($name)  .'" <' . $email . '>';

		if(!in_array($formatted, $this->bccList))
			$this->bccList[] = $formatted;

		return $this;
	}

	/**
	 * Return the formatted blind carbon copy recipient list
	 * @return array
	 */
	public function getBccRecipients()
	{
		return $this->bccList;
	}

	/**
	 * Set the sender of the email
	 * @param  string $name  Sender name. This parameter is optional.
	 * @param  string $email Sender email.
	 * @return FastMailBuilder $this
	 */
	public function from($name, $email = null)
	{
		$this->from = $email === null ? $name : '"' . $this->encodeWord($name)  .'" <' . $email . '>';
		$this->fromEmail = $email ?: $name;
		return $this;
	}

	/**
	 * Return formatted email sender information
	 * @return string
	 */
	public function getFrom()
	{
		return $this->from;
	}

	/**
	 * Address of the actual sender acting on behalf of the email author (wich specified with FastMailBuilder::from)
	 * @param  string $email
	 * @return FastMailBuilder $this
	 */
	public function sender($email)
	{
		$this->sender = $email;
		return $this;
	}

	/**
	 * Address of the actual sender acting on behalf of the email author
	 * @return string
	 */
	public function getSender()
	{
		return $this->sender;
	}

	/**
	 * Set the address to send the read receipt
	 * @param  string $email
	 * @return FastMailBuilder $this
	 */
	public function comfirmReading($email)
	{
		$this->readReceipt = $email;
		return $this;
	}

	/**
	 * Return the subject of the email
	 * @return string
	 */
	public function getReadReceipt()
	{
		return $this->readReceipt;
	}

	/**
	 * Set the email subject
	 * @param  string $newSubject
	 * @return FastMailBuilder $this
	 */
	public function subject($newSubject)
	{
		$this->subject = $newSubject;
		return $this;
	}

	/**
	 * Return the subject of the email
	 * @return string
	 */
	public function getSubject()
	{
		return $this->subject;
	}

	/**
	 * Set the reply-to address of the email
	 * @param  string $newReplyTo Reply email adress
	 * @return FastMailBuilder $this
	 */
	public function replyTo($newReplyTo)
	{
		$this->replyTo = $newReplyTo;
		return $this;
	}

	/**
	 * Return the email's reply-to address
	 * @return string
	 */
	public function getReplyTo()
	{
		return $this->replyTo;
	}

	/**
	 * Append a string to the raw body
	 * @param  string $append
	 * @return FastMailBuilder $this
	 */
	public function body($append)
	{
		$this->body .= $append;
		$this->state = self::CUSTOM;
		return $this;
	}

	/**
	 * Empty the email and optionaly set a new content.
	 * @param  string $newBody
	 * @return FastMailBuilder $this
	 */
	public function clearBody($newBody = '')
	{
		$this->body = $newBody;
		$this->state = self::CUSTOM;
		return $this;
	}

	/**
	 * Return the message body
	 * @return string
	 */
	public function getBody()
	{
		return $this->body;
	}

	/**
	 * Add a custom header to the email
	 * @param  string  $name   header name
	 * @param  string  $value  header value
	 * @param  boolean $encode
	 * @return FastMailBuilder $this
	 */
	public function header($name, $value, $encode = true)
	{
		if($encode)
			$value = $this->encodeWord($value);

		$this->customHeaders[] = array($name, $value);
		return $this;
	}

	/**
	 * Delete every custom headers
	 * @param  string $newBody
	 * @return FastMailBuilder $this
	 */
	public function clearHeaders()
	{
		$this->customHeaders = array();
		return $this;
	}

	/**
	 * Return custom headers
	 * @return string
	 */
	public function getHeaders()
	{
		return $this->customHeaders;
	}

	/**
	 * Add a text part - multipart email
	 * @param  string $message
	 * @return FastMailBuilder $this
	 */
	public function text($message)
	{
		if(empty($message))
			throw new Exception('Text part can not be empty.');
		else if($this->state != self::MULTIPART)
		{
			$this->body .= '--' . $this->boundary . $this->nl;
			$this->body .= 'Content-Type: multipart/alternative; boundary="' . $this->partBoundary . '"' . $this->nl . $this->nl;

			$this->state = self::MULTIPART;
		}

		$this->body .= '--' . $this->partBoundary . $this->nl;
		$this->body .= 'Content-Type: text/plain; charset=UTF-8' . $this->nl;
		$this->body .= 'Content-Transfer-Encoding: base64' . $this->nl;
		$this->body .= $this->nl . chunk_split(base64_encode(str_replace("\n", $this->nl, $message)), self::CHUNKLEN, $this->nl) . $this->nl;

		return $this;
	}

	/**
	 * Add an html part - multipart email
	 * @param  string $message
	 * @return FastMailBuilder $this
	 */
	public function html($message)
	{
		if(empty($message))
			throw new Exception('HTML part can not be empty.');
		else if($this->state != self::MULTIPART)
		{
			$this->body .= '--' . $this->boundary . $this->nl;
			$this->body .= 'Content-Type: multipart/alternative; boundary="' . $this->partBoundary . '"' . $this->nl . $this->nl;

			$this->state = self::MULTIPART;
		}

		$this->body .= '--' . $this->partBoundary . $this->nl;
		$this->body .= 'Content-Type: text/html; charset=UTF-8' . $this->nl;
		$this->body .= $this->nl . str_replace("\n", $this->nl, $message) . $this->nl . $this->nl;

		return $this;
	}

	/**
	 * Add an attachment to the email
	 * @param  string $file file path
	 * @param  string $name file name, optional
	 * @return FastMailBuilder $this
	 */
	public function attachment($file, $name = null)
	{
		$this->state = self::ATTACHMENTS;

		if($name === null)
			$name = basename($file);

		$mime = mime_content_type($name);

		$this->body .= '--' . $this->boundary . $this->nl;
		$this->body .= 'Content-Type: ' . $mime . '; name=' . $this->encodeWord($name) . $this->nl;
		$this->body .= 'Content-Transfer-Encoding: base64' . $this->nl;
		$this->body .= 'Content-Disposition: attachment' . $this->nl;
		$this->body .= $this->nl . chunk_split(base64_encode(file_get_contents($file)), self::CHUNKLEN, $this->nl) . $this->nl;

		return $this;
	}

	/**
	 * Send the email to all recipients
	 * @return boolean Whether the sending is successful
	 */
	public function send()
	{
		if(empty($this->from))
			throw new Exception('The email must have a from header.');

		$headers = 'From: ' . $this->from . $this->nl;
		if(!empty($this->replyTo))
			$headers .= 'Reply-To: ' . $this->replyTo . $this->nl;
		if(!empty($this->ccList))
			$headers .= 'Cc: ' . implode(', ', $this->ccList) . $this->nl;
		if(!empty($this->bccList))
			$headers .= 'Bcc: ' . implode(', ', $this->bccList) . $this->nl;
		if(!empty($this->sender))
			$headers .= 'Sender: ' . $this->sender . $this->nl;
		if(!empty($this->readReceipt))
			$headers .= 'X-Confirm-Reading-To: ' . $this->readReceipt . $this->nl;
		$headers .= 'MIME-Version: 1.0' . $this->nl;
		$headers .= 'Content-Type: multipart/mixed; boundary="' . $this->boundary . '"' . $this->nl;

		foreach($this->customHeaders as $customHeader)
			$headers .= $customHeader[0] . ': ' . $customHeader[1] . $this->nl;

		if(empty($this->body))
			throw new Exception('The email must have a body.');

		$mailBody = $this->body . '--' . $this->boundary . $this->nl;

		if($this->sendMode == self::SEPARATED)
		{
			$success = true;
			foreach($this->sendList as $to)
				$success = $success && mail($to, $this->encodeWord($this->subject), $mailBody, $headers);

			return $success;
		}
		else
			return mail(implode(', ', $this->sendList), $this->encodeWord($this->subject), $mailBody, $headers, $sendmailParams);
	}
}
