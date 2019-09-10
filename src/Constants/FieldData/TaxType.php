<?php

namespace NotaFiscalSP\Constants\FieldData;

class TaxType
{
    // Tributação no municipio de São Paulo;
    const IN_SP = 'T';

    // Tributação fora do municipio de São Paulo
    const OUT_SP = 'F';

    // Isento
    const EXEMPTED = 'I';

    // ISS Suspenso por Decisão Judicial.
    const SUSPENDED = 'J';

    // Tributado em São Paulo, porém Isento
    const IN_SP_EXEMPTED = 'A';

    // Tributado Fora de São Paulo, porém Isento
    const OUT_SP_EXEMPTED = 'B';

    // Tributado em São Paulo com isenção parcia
    const IN_SP_PARTIAL_EXEMPTED = 'D';

    // Tributado em São Paulo, porém com indicação de imunidade subjetiva
    const IN_SP_SUBJECTIVE_IMMUNITY = 'M';

    // Tributado fora de São Paulo, porém com indicação de imunidade subjetiva
    const OUT_SP_SUBJECTIVE_IMMUNITY = 'N';

    // Tributado em São Paulo, porém com indicação de imunidade Objetiva
    const IN_SP_OBJECTIVE_IMMUNITY = 'R';

    // Tributado fora de São Paulo, porém com indicação de imunidade Objetiva
    const OUT_SP_OBJECTIVE_IMMUNITY = 'S';

    //Tributado em São Paulo, porém Exigibilidade Suspensa
    const IN_SP_DEMAND_SUSPENDED = 'X';

    //Tributado fora de São Paulo, porém Exigibilidade Suspensa
    const OUT_SP_DEMAND_SUSPENDED = 'V';

    // Exportação de Serviços
    const SERVICE_EXPORTATION = 'P';


}