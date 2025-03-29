
# Sistema de Gestão de Frotas Públicas

Este projeto é um sistema de gerenciamento de frotas desenvolvido em **Laravel 12 com Livewire**, seguindo as diretrizes da **Cartilha da Gestão da Frota Pública**.

Tem como objetivo garantir controle, rastreabilidade e eficiência no uso dos veículos públicos, permitindo:

- Cadastro e controle de veículos
- Gestão de motoristas
- Autorizações e controle de uso dos veículos
- Abastecimento e manutenção
- Controle de quilometragem mensal
- Relatórios por unidade e geral da frota

## 🧩 Tecnologias Utilizadas

- Laravel 12
- Livewire
- Tailwind CSS
- Spatie Laravel Permission (Controle de Acesso)

---

## 👥 Perfis de Usuários e Responsabilidades

| Perfil                      | Responsabilidades                                                                                  |
|----------------------------|-----------------------------------------------------------------------------------------------------|
| **Admin**                  | - Gerenciar usuários e permissões<br>- Criar unidades e vincular veículos<br>- Configurar sistema geral<br>- Visualizar e editar todos os dados |
| **Gestor da Frota**        | - Cadastrar e manter veículos<br>- Cadastrar motoristas<br>- Autorizar uso dos veículos<br>- Aprovar abastecimentos e manutenções<br>- Lançar KM inicial e final do mês por veículo<br>- Gerar relatórios da frota |
| **Gestor da Unidade Adm.** | - Solicitar uso de veículos<br>- Autorizar uso dos veículos da sua unidade<br>- Visualizar relatórios dos veículos da unidade |
| **Garage Manager**         | - Realizar entrega e recebimento dos veículos<br>- Registrar vistorias de saída e retorno<br>- Controlar a entrada/saída dos veículos<br>- Registrar ocorrências na devolução |
| **Motorista**              | - Visualizar seus próprios dados e veículos atribuídos<br>- Registrar informações de uso (km, horário, destino)<br>- Solicitar manutenção emergencial<br>- Reportar problemas (pane, infrações) |

---

## 📚 Documentação Oficial

Este projeto segue como referência a **Cartilha da Gestão da Frota Pública**, exigida pelo Tribunal de Contas para prestação de contas e auditoria das frotas públicas.

---

## ✅ Status Atual do Projeto

- [x] Controle de usuários e permissões
- [x] Cadastro de motoristas e veículos
- [x] Estrutura para controle de KM mensal
- [ ] Estrutura para controle de abastecimento
- [ ] Módulo de solicitação e autorização de uso de veículos
- [ ] Controle de quilometragem mensal
- [ ] Relatórios gerenciais

---

## ⚙️ Contribuindo

Contribuições são bem-vindas. Para rodar o projeto localmente:

```bash
git clone https://github.com/giluansouza/gestao-frotas.git
cd gestao-frotas
cp .env.example .env
composer install
php artisan migrate --seed
php composer run dev
```

---

## 📄 Licença

Este projeto é de uso restrito da organização pública responsável. Direitos reservados.
