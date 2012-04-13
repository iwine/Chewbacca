<?php
namespace Chewbacca\CartBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/** 
 *  @ORM\Entity 
 *  @ORM\HasLifecycleCallbacks()
 * 
 **/
 class Cart{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var integer $id
     *
     * @ORM\Column(name="total_items", type="integer")
     */
    protected $total_items = 0;

    /**
     * @var datetime $expires_at
     *
     * @ORM\Column(name="expires_at", type="datetime")
     */
    protected $expires_at;

    /**
     * @var string $value
     *
     * @ORM\Column(name="value", type="decimal", scale=2)
     */
    protected $value = 0.00;

    /**
     * @ORM\OneToMany(targetEntity="\Chewbacca\CartBundle\Entity\CartItem", mappedBy="cart")
     */
    protected $cart_items;


    public function __construct()
    {
        $this->cart_items = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set total_items
     *
     * @param integer $totalItems
     * @return Cart
     */
    public function setTotalItems($totalItems)
    {
        $this->total_items = $totalItems;
        return $this;
    }

    /**
     * Get total_items
     *
     * @return integer 
     */
    public function getTotalItems()
    {
        return $this->total_items;
    }

    /**
     * Set expires_at
     * @ORM\prePersist
     * @param datetime $expiresAt
     * @return Cart
     */
    public function setExpiresAt(\DateTime $expiresAt = null)
    {
        if($expiresAt){
            $this->expires_at = $expiresAt;
        }else{
             $this->incrementExpiresAt();
        }
        return $this;
    }

    public function incrementExpiresAt()
    {
        $expiresAt = new \DateTime();
        $expiresAt->add(new \DateInterval('PT3H'));

       return $this->setExpiresAt($expiresAt);
    }

    /**
     * Get expires_at
     *
     * @return datetime 
     */
    public function getExpiresAt()
    {
        return $this->expires_at;
    }

    /**
     * Set value
     *
     * @param decimal $value
     * @return Cart
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }

    /**
     * Get value
     *
     * @return decimal 
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Add cart_items
     *
     * @param Chewbacca\CartBundle\Entity\CartItem $cartItems
     */
    public function addCartItem(\Chewbacca\CartBundle\Entity\CartItem $cartItems)
    {
        $this->cart_items[] = $cartItems;
    }

    /**
     * Get cart_items
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getCartItems()
    {
        return $this->cart_items;
    }
}