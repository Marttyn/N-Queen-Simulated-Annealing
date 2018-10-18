# N-Queen-Simulated-Annealing

Grupo:<br>
Daniela Costa<br>
Rafael Oliveira<br>
Thulio Batista<br>
Wallace Augusto<br>

Problema:<br>
Estado inicial: Cada rainha em uma linha, em um coluna aleatória.<br>
Função sucessor: Retorna todos os possíveis estados ao mover uma rainha para outra casa na mesma linha.<br>
Função objeto: Todas as N rainhas posicionadas de forma que não se ataquem.<br>
Custo: custo fixo de 1 ao mover uma rainha.<br>

Solução escolhida: Têmpera Simulada.<br>
Justificativa da escolha: Foi uma solução mais viável para a solução do problema, possuindo uma heuristica que mais se adaptou ao problema.

Análise do desenvolvimento:<br>
Depois de escolhida a solução que seria utilizada, pensamos em uma heuristica para a solução do problema e o custo de movimentação das rainhas. Optamos por utilizar PHP pela facilidade de implementação da interface do tabuleiro e por ser uma linguagem leve. Após tal definição a devida implementação não apresentou muita dificuldade.

Como executar:<br>
É necessário a utilização de um webservice para executar a aplicação.<br>
Execute o arquivo index.php e selecione o numero de rainhas, o numero de iterações, a temperatura e a taxa de resfriamento. Será apresentado as movimentações realizadas e por fim o tabuleiro final junto a uma mensagem se a solução foi encontrada ou não.
