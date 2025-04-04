# Progresso do MVP - Gestão de Frotas

## ✅ Concluído

### CRUDs

- [x] Motoristas (Drivers)
- [x] Veículos (Vehicles)
- [x] Controle de KM
- [x] Níveis de usuários e permissões
- [x] Policy de abastecimentos
- [x] Testes automatizados da policy
- [x] Factory completa de Fueling
- [x] Manutenção de veículos (Maintenance)
- [x] Utilização de veículos (VehicleUsage)

### Regras de negócios

- [x] Não permitir exclusão de veículos/motoristas vinculados a abastecimento
- [x] Registro de quem autorizou o abastecimento (authorized_by)
- [ ] Validar KM no abastecimento para evitar que seja menor que o último abastecimento
- [ ] Admin poderá configurar quais tipos de gestores poderão autorizar liberação de veículo

## 🚧 Em andamento

- [x] Abastecimentos (Fuelings) - com autorização por gestor
- [x] Cálculo automático do custo total (litros * valor por litro)
- [x] Validação: hodômetro > último abastecimento
- [x] Listagem e filtros na tela de abastecimentos (`Fueling/Index`)
- [x] Tela de edição (`Fueling/Edit`)
- [x] Política de autorização por tipo de usuário (gate/policy)
- [ ] Tela de resumo mensal por veículo (km inicial/final)

## 📌 Próximas etapas

- [ ] Relação entre veículos e motoristas preservada (onDelete restrict)
- [ ] Exportação de relatórios exigidos pelo TCE
- [ ] Controle de manutenção (preventiva/corretiva)
- [ ] Controle por contrato de abastecimento (cartão)
- [ ] Notificações por vencimento de CNH
- [ ] Auditoria e histórico de alterações

## Sprint 1 - Autenticação e Controle de Acesso

- [x] Login/logout
- [x] Middleware de roles e permissões

## Sprint 2 - Cadastro de Veículos e Motoristas

- [x] CRUD de Vehicles
- [x] CRUD de Drivers

## Sprint 3 - Combustível

- [x] CRUD de FuelStation

## Sprint 4 - Oficinas

- [x] CRUD de RepairShop

## Sprint 5 - Controle de Km Mensal

- [x] Tela de registro de km inicial/final por mês

## Sprint 6 - Manutenções

- [x] CRUD completo de Maintenance
- [x] Permissões por status
- [x] Relacionamento com RepairShop
- [x] Exclusão com confirmação

## Sprint 7 - Utilização de Veículos

- [x] Solicitação de uso (RequestForm)
- [x] Autorização da solicitação (AuthorizeTable)
- [x] Liberação de veículo (Dispatch)
- [x] Registro do retorno (ReturnForm)
- [x] Controle de KM inicial e final
- [x] Registro de observações e ocorrências
- [x] Confirmação obrigatória de vistoria
- [x] Políticas por papel: driver vs garage_manager

## Sprint 8 - A definir

- [ ] ...

---

Atualizado automaticamente via Livewire + ChatGPT Sprint Manager.
