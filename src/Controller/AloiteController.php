<?php 

namespace App\Controller;

use App\Entity\Aloite;
use App\Form\AloiteFormType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\JsonResponse;


/* aloitekanta-tietokantaan:
aloitteen aihe (aihe)
•aloitteen tarkempi kuvaus (kuvaus)
•aloitteen kirjauspäivä (kirjauspvm)
•aloitteen tekijän etu- ja sukunimi (nimi)
•sähköpostiosoite, yhteyden ottoa varten (email)
*/


/* 
- Aloitteen tekeminen
•Aloitteen tulostaminen (tulosteeseen vain aihe, kuvaus ja kirjauspäiväys)
•Aloitteen poistaminen
•Aloitteen muokkaaminen
•Yksittäisen aloitteen kaikkien tietojen näyttäminen
*/

/* Mitä tarvitaan? 
1. index-sivu taulukko, joka listaa kaikki aloitteet (aihe, kuvaus ja kirjauspvm),
ja jossa on nappulat näytä, muokkaa ja poista
2. Sivu, jossa näytetään index-sivulta näytä-nappulasta valittu 
yksittäisen aloitteen kaikki tiedot
3. sivu, jossa voi muokata aloitetta
4. poista-toiminto, joka näyttää ponnahdusikkunan ja varmistaa että olet varma
että haluat poistaa. Tämä avautuu kun painetaan poista-nappulaa. Kun painat 
poista, poistaa kyseisen aloitteen.
5. sivu jossa voi kirjoittaa aloitteen.
*/ 

class AloiteController extends AbstractController {

    /** 
     * @Route("/aloitteet", name="aloite_lista")
    */
    public function index(){
        // Hakee kaikki aloitteet tietokannasta
        $aloitteet = $this->getDoctrine()->getRepository(Aloite::class)->findAll();

        // Pyydetään näkymää näyttämään kaikki linkit
        return $this->render('aloite/index.html.twig', [
            'aloitteet' => $aloitteet
        ]);
    }


    /** 
     * @Route("/aloitteet/uusi", name="aloite_uusi")
    */
    public function uusi(Request $request) {
        // luodaan Aloite-olio
        $aloite = new Aloite();

        // Luodaan lomake
        $form = $this->createForm(
            AloiteFormType::class,
            $aloite, [
                'action' => $this->generateUrl('aloite_uusi'),
                'attr' => ['class' => 'form-signin']
            ]
        );

        // Käsitellään lomakkeelta tulleet tiedot ja talletetaan tietokantaan
        $form->handleRequest($request);
        if($form->isSubmitted()){
            // Tallennetaan lomaketiedot muuttujaan
            $aloite = $form->getData();

            // Tallennetaan tietokantaan
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($aloite);
            $entityManager->flush();

            // Kutsutaan index-controlleria
            return $this->redirectToRoute('aloite_lista');
        }
        
        return $this->render('aloite/uusi.html.twig', [
            'form1' => $form->createView()
        ]);
    }

    /** 
     * @Route("/aloitteet/nayta/{id}", name="aloite_nayta")
    */
    public function nayta($id) {
        $aloite = $this->getDoctrine()->getRepository(Aloite::class)->find($id);

        return $this->render('aloite/nayta.html.twig', [
            'aloite' => $aloite
        ]);
    }

    /**  
     * @Route("/aloitteet/muokkaa/{id}", name="aloite_muokkaa")
    */
    public function muokkaa(Request $request, $id) {
        $aloite = new Aloite();
        $aloite = $this->getDoctrine()->getRepository(Aloite::class)->find($id);

        // Luodaan lomake
        $form = $this->createForm(
            AloiteFormType::class,
            $aloite, [
                'attr' => ['class' => 'form-signin']
            ]
        );

        // Käsitellään lomakkeelta tulleet tiedot ja talletetaan tietokantaan
        $form->handleRequest($request);
        if($form->isSubmitted()){
            // Tallennetaan lomaketiedot muuttujaan
            $aloite = $form->getData();

            // Tallennetaan tietokantaan
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();

            // Kutsutaan index-controlleria
            return $this->redirectToRoute('aloite_lista');
        }

        return $this->render('aloite/muokkaa.html.twig', [
            'form1' => $form->createView()
        ]);
    }


    /** 
     * @Route("/aloite/poista/{id}", name="aloite_poista")
    */
    public function poista(Request $request, $id) {
        $aloite = $this->getDoctrine()->getRepository(Aloite::class)->find($id);

        // Poistetaan linkki tietokannasta
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($aloite);
        $entityManager->flush();
        
        return $this->redirectToRoute('aloite_lista');
    
    }

}


?>