# Arquitetura do Tema WordPress "empath" (portal-vivasp)

## Visão arquitetural

O sistema é um tema WordPress estruturado para fornecer uma experiência de blog e loja online (via WooCommerce). Ele segue a arquitetura padrão do WordPress baseada em templates PHP, hooks, e funções auxiliares. O tema é modular, com separação clara entre templates, funções auxiliares, e assets estáticos.

## Componentes / camadas

- **Templates PHP**: Arquivos como `index.php`, `single.php`, `page.php`, `archive.php` que definem a estrutura das páginas.
- **Template Parts**: Fragmentos reutilizáveis em `/template-parts/` para conteúdo de posts, páginas, busca, etc.
- **Funções e Helpers**: Em `/inc/`, funções para carregar scripts, registrar widgets, manipular loops, breadcrumbs, comentários, etc.
- **Bookmark System**: Em `/bookmark/functions.php`, gerencia favoritos via AJAX, armazenando meta de usuário.
- **Assets Estáticos**: CSS e JS em `/assets/` para estilos e interatividade (ex: carrosséis, sticky header).
- **Integração com Plugins**: Suporte a WooCommerce, Elementor, Jetpack.

## Integrações externas

- **WordPress Core**: Utiliza APIs de template, meta, AJAX, widgets.
- **WooCommerce**: Suporte para loja, com remoção de hooks padrão para customização.
- **Elementor**: Para renderização customizada de cabeçalhos e rodapés.
- **Google Fonts**: Carregamento via URL configurado em `functions.php`.
- **Bibliotecas JS**: Bootstrap, Swiper, Slick, mb-YTPlayer, MetisMenu.

## Fluxo principal (passo a passo)

1. Usuário acessa uma página/post.
2. WordPress determina o template adequado (ex: `single.php` para post único).
3. Template chama `get_header()`, que carrega `header.php` e executa `Empath_Helper::empath_header_template()` para renderizar cabeçalho.
4. Conteúdo principal é exibido via loops customizados (`empath_post_loop()`, `empath_single_post_layout()`, etc).
5. Breadcrumbs são gerados via hook `empath_before_main_content` e função `empath_breadcrumb()`.
6. Sidebar é carregada se ativa.
7. Footer é carregado via `get_footer()` e `Empath_Helper::empath_footer_template()`.
8. Scripts JS são enfileirados e executados, incluindo funcionalidades AJAX para bookmarks.
9. Usuário pode interagir com bookmarks, que acionam AJAX para adicionar/remover favoritos.

## Pontos de falha e observabilidade

- **Bookmarks AJAX**: Falha se nonce inválido ou usuário não autenticado. Retorna erro JSON.
- **Dependência de Plugins**: Se Elementor ou WooCommerce não estiverem ativos, algumas funcionalidades podem falhar.
- **Carregamento de Assets**: Scripts são carregados com defer para performance, mas erros JS podem impactar UX.
- **Custom Header/Footer via Elementor**: Se o post configurado não existir ou Elementor não estiver ativo, fallback para template padrão.
- **Breadcrumbs**: Dependem de meta e opções, podem não exibir corretamente se dados ausentes.

Não há evidência de logs ou monitoramento explícito no código.

---

Arquivos base: `functions.php`, `inc/qubar-functions.php`, `bookmark/functions.php`, `inc/qubar-helper-class.php`, templates PHP.