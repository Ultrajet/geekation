$("document").ready(() => {
    function appelAPI($produit) {
        console.log("jQuery activé!");
        console.log($produit);

        // if ('{{ produit.type }}' == 'jeu') {
        //     $url = 'game';
        // }
        // else if ('{{ produit.type }}' == 'console') {
        //     $url = 'platform';
        // }
        // else if ('{{ produit.type }}' == 'accessoire') {
        //     $url = 'accessory';
        // }

        // console.log('{{ produit.type }}');

        // // dans cette requête GET, on demande le produit par le guid, puis on reçoit une réponse en json/jsonp/je-sais-pas-trop-mais-cette-combinaison-de-paramètres-fonctionne
        // $.ajax({
        //     method: 'GET',
        //     url: 'https://www.giantbomb.com/api/' + $url + '/{{ produit.guid }}',
        //     dataType: 'jsonp',
        //     jsonp: 'json_callback',
        //     data: {
        //         api_key: 'e009edce3a7d7316c39b6b6f8aa51b1cbe09ae80',
        //         format: 'jsonp'
        //     }
        // }).done((data) => {
        //     // ici on manipule la réponse envoyée par GiantBomb à travers la variable data
        //     // d'abord un petit console.log pour avoir en console la totalité de la réponse à portée de main
        //     console.log(data.results);

        //     // puis on assigne à des éléments du DOM les morceaux de data qui nous intéressent
        //     if ('{{ produit.type }}' == 'jeu') {
        //         console.log('jeu ok!');
        //         $("#imageproduit").attr("src", data.results.image.medium_url);
        //         $("#description").html(data.results.deck);
        //         $("#developpeurs").html(data.results.developers[0].name);
        //         $("#genre").html(data.results.genres[0].name);
        //     }
        //     else if ('{{ produit.type }}' == 'console') {
        //         console.log('console ok!');
        //         $("#imageproduit").attr("src", data.results.image.medium_url);
        //         $("#description").html(data.results.deck);
        //         $("#compagnie").html(data.results.company.name);
        //     }
        //     else {
        //         console.log('accessoire ok!');
        //         $("#imageproduit").attr("src", data.results.image.medium_url);
        //         $("#description").html(data.results.deck);
        //     }
        // });
    };
});