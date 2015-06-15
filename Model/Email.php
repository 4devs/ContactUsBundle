<?php

namespace FDevs\ContactUsBundle\Model;

class Email implements EmailInterface
{
    use EmailTrait;
    use MessageTrait;
}
