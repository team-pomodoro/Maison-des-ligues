<?php

namespace App\Repository;

use App\Entity\Licencie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Licencie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Licencie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Licencie[]    findAll()
 * @method Licencie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LicencieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Licencie::class);
    }
    
     /**
     * verifie que le numero de licence existe deja dans la table licencie
     * @return bool
     */
        public function numLicenceExiste(int $num_licence): bool
    {
        $entityManager = $this->getEntityManager();

//        $query = $entityManager->createQuery();//->setParameter('num_licence', $num_licence);
        
        $query = $entityManager->createQueryBuilder();
       
        $query->select('l.numLicence');
        $query->from('App\Entity\numLicence', 'l');
        $query->where('l.numLicence = :num_licence');
        $query->setParameter('num_licence', $num_licence);
        
        
// 'SELECT num_licence
//            FROM App\Entity\Compte
//            WHERE num_licence = :num_licence'
        return !empty($query->getQuery()->getResult());
    }

    
    /** Modifie les donner de la table licencie depuis la gestion de compte**/
    public function updateLicencier($num_licencier, $prenom, $nom, $mail)
{
    return $this->createQueryBuilder()
        ->update('models\Licencier', 'l')
        ->set('u.prenom', ':prenom')
        ->set('u.nom', ':nom')
        ->set('u.mail', ':mail')
        ->andWhere('l.num_licencier = :num_licencier')
        ->setParameter('prenom', $prenom)
        ->setParameter('nom', $nom)
        ->setParameter('mail', $mail)
        ->setParameter('num_licencier', $num_licencier)
        ->getQuery()->exexute();
}
    // /**
    //  * @return Licencie[] Returns an array of Licencie objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */
    

    /*
    public function findOneBySomeField($value): ?Licencie
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
