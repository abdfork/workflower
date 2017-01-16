<?php

namespace PHPMentors\Workflower\Workflow\Activity;

use PHPMentors\Workflower\Workflow\Operation\OperationalInterface;
use PHPMentors\Workflower\Workflow\Participant\Role;


class UserTask extends Task
{
    /**
     * @param int|string $id
     * @param Role       $role
     * @param string     $name
     */
    public function __construct($id, Role $role, $name = null)
    {
        parent::__construct($id, $role, $name);

    }

    /**
     * {@inheritdoc}
     */
    public function serialize()
    {
        return serialize(array(
            get_parent_class($this) => parent::serialize()
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function unserialize($serialized)
    {
        foreach (unserialize($serialized) as $name => $value) {
            if ($name == get_parent_class($this)) {
                parent::unserialize($value);
                continue;
            }

            if (property_exists($this, $name)) {
                $this->$name = $value;
            }
        }
    }
}
