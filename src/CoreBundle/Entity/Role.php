<?php
namespace CoreBundle\Entity;
use CoreBundle\Entity\Users;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\Role\RoleInterface;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Table(name="roles")
 * @ORM\Entity()
 */
class Role implements RoleInterface
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @ORM\Column(name="name", type="string", length=30)
     */
    private $name;
    /**
     * @ORM\Column(name="role", type="string", length=20, unique=true)
     */
    private $role;
    /**
     * @var Users $users
     * @ORM\ManyToMany(targetEntity="Users" , mappedBy="userRoles")
     */
    private $users;
    public function __construct()
    {
        $this->users = new ArrayCollection();
    }
    /**
     * Returns the role.
     *
     * This method returns a string representation whenever possible.
     *
     * When the role cannot be represented with sufficient precision by a
     * string, it should return null.
     *
     * @return string|null A string representation of the role, or null
     */
    public function getRole()
    {
        return $this->role;
    }
    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * Set name
     *
     * @param string $name
     * @return Role
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }
    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
    /**
     * Set role
     *
     * @param string $role
     * @return Role
     */
    public function setRole($role)
    {
        $this->role = $role;
        return $this;
    }

    /**
     * @param Users $users
     * @return $this
     */
    public function addUser(Users $users)
    {
        $this->users[] = $users;
        return $this;
    }

    /**
     * @param Users $users
     */
    public function removeUser(Users $users)
    {
        $this->users->removeElement($users);
    }
    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsers()
    {
        return $this->users;
    }
}