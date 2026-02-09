# portal-vivasp - Documentação Técnica

## Visão geral do sistema

Este repositório contém um tema WordPress chamado "empath" para o site portal-vivasp. O tema é focado em blogs, com suporte a posts, páginas, categorias, arquivos, busca, e funcionalidades específicas como bookmarks (favoritos) para usuários autenticados. Também há suporte a WooCommerce para funcionalidades de loja online.

O tema utiliza o framework CS para opções de tema e configurações, e integra funcionalidades como carregamento assíncrono de posts, navegação customizada, e suporte a formatos de posts variados (vídeo, áudio, galeria).

## Como rodar localmente

1. Instale um ambiente WordPress local (ex: Local by Flywheel, XAMPP, MAMP).
2. Clone o repositório para a pasta de temas do WordPress (`wp-content/themes/portal-vivasp` ou similar).
3. Ative o tema "empath" no painel administrativo do WordPress.
4. Instale e ative os plugins necessários, como Elementor (se usar cabeçalhos/rodapés customizados via Elementor).
5. Configure as opções do tema via painel de opções (CS Framework).

## Variáveis de ambiente

Não foi possível confirmar variáveis de ambiente específicas. O tema depende das configurações do WordPress e do banco de dados padrão.

## Estrutura de pastas (alto nível)

- `/` - raiz do tema, contém arquivos principais de template (index.php, single.php, page.php, etc).
- `/inc/` - funções auxiliares, classes, configurações do tema, integração com plugins, helpers.
- `/bookmark/` - funcionalidades relacionadas a bookmarks (favoritos) do usuário.
- `/template-parts/` - partes de templates reutilizáveis para posts, páginas, conteúdo.
- `/assets/` - arquivos estáticos como CSS, JS, imagens.

## Principais fluxos

- Renderização de páginas e posts via templates padrão do WordPress.
- Loop de posts customizado com paginação (função `empath_post_loop` em `inc/qubar-functions.php`).
- Sistema de bookmarks para usuários autenticados, com AJAX para adicionar/remover favoritos (`bookmark/functions.php` e JS em `assets/js/forcast-core.js`).
- Breadcrumbs dinâmicos baseados no tipo de página e configurações de meta.
- Suporte a WooCommerce com remoção de algumas ações padrão para customização.

## Dependências relevantes

- WordPress (versão não especificada).
- Plugins: Elementor (opcional, para cabeçalhos/rodapés customizados), WooCommerce.
- Framework CS para opções de tema.
- Bibliotecas JS: jQuery, Bootstrap, Swiper, Slick, mb-YTPlayer, MetisMenu.

## Observações e riscos

- O tema depende fortemente do framework CS para opções e meta boxes.
- Integração com Elementor para cabeçalhos e rodapés pode causar dependência externa.
- Sistema de bookmarks depende de AJAX e meta de usuário, pode ter problemas de performance com muitos usuários.
- Não há evidência de testes automatizados.
- Algumas funções e classes são carregadas condicionalmente, o que pode gerar erros se plugins não estiverem ativos.

---

Arquivo base para informações: `README.md`, `functions.php`, `bookmark/functions.php`, `inc/qubar-functions.php`, templates PHP na raiz e `template-parts/`.