SELECT 
                      c.id AS id_carrier,
                      c.id_document_type,
                      dt.description AS document_type,
                      c.name,
                      c.document_number,
                      c.address,
                      c.phone,
                      c.business_name,
                      c.email,
                      c.status
                  FROM carrier c
                  INNER JOIN document_type dt ON dt.id = c.id_document_type
                  WHERE c.status = 1