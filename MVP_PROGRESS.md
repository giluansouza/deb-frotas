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

### Regras de negócios

- [x] Não permitir exclusão de veículos/motoristas vinculados a abastecimento
- [x] Registro de quem autorizou o abastecimento (authorized_by)
- [ ] Validar KM no abastecimento para evitar que seja menor que o último abastecimento

## 🚧 Em andamento

- [ ] Abastecimentos (Fuelings) - com autorização por gestor
- [ ] Cálculo automático do custo total (litros * valor por litro)
- [ ] Validação: hodômetro > último abastecimento
- [ ] Listagem e filtros na tela de abastecimentos (`Fueling/Index`)
- [ ] Tela de edição (`Fueling/Edit`)
- [ ] Política de autorização por tipo de usuário (gate/policy)
- [ ] Tela de resumo mensal por veículo (km inicial/final)

## 📌 Próximas etapas

- [ ] Relação entre veículos e motoristas preservada (onDelete restrict)
- [ ] Exportação de relatórios exigidos pelo TCE
- [ ] Controle de manutenção (preventiva/corretiva)
- [ ] Controle por contrato de abastecimento (cartão)
- [ ] Notificações por vencimento de CNH
- [ ] Auditoria e histórico de alterações
