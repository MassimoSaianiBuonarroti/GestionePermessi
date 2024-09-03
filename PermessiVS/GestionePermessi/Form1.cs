using System.IO;
using System.Net.NetworkInformation;
using System.Security.Cryptography;
using System.Text;

namespace GestionePermessi
{
    public partial class Form1 : Form
    {
        public struct DatiStudente
        {
            public string cognome, nome, classe;

            public string cognome_padre, nome_padre, utente_padre;
            public string cognome_madre, nome_madre, utente_madre;

            public string cognome_tutore, nome_tutore, utente_tutore;
            public string cognome_affidatario, nome_affidatario, utente_affidatario;
            public string cognome_affidataria, nome_affidataria, utente_affidataria;
        }



        public Form1()
        {
            InitializeComponent();
        }

        private void caricaFileCSVMastercomToolStripMenuItem_Click(object sender, EventArgs e)
        {
            DialogApriFileCSV.ShowDialog();
        }

        private void DialogApriFileCSV_FileOk(object sender, System.ComponentModel.CancelEventArgs e)
        {
            string nomefile = DialogApriFileCSV.FileName;
            string message = "Selezionato file " + nomefile + ". Confermi?";
            string caption = "Caricamento file CSCV Mastercom";
            MessageBoxButtons buttons = MessageBoxButtons.YesNo;

            // Displays the MessageBox.
            DialogResult result = MessageBox.Show(message, caption, buttons);
            if (result == System.Windows.Forms.DialogResult.Yes)
            {
                try
                {
                    try
                    {
                        string[] lines = System.IO.File.ReadAllLines(nomefile.Trim());
                        foreach (string line in lines)
                        {
                            listCSV.Items.Add(line);
                        }
                        convertiTABInVIRGOLAToolStripMenuItem.Enabled = true;
                    }
                    catch { }
                    {

                    }

                }
                catch { }
                {
                }

            }


        }

        private void convertiTABInVIRGOLAToolStripMenuItem_Click(object sender, EventArgs e)
        {
            // metti nella variabile lines le linee di testo del file
            ListBox.ObjectCollection lines = listCSV.Items;

            // salva quante righe sono, da usare per il ciclo FOR
            int lines_count = listCSV.Items.Count;

            // cicla su tutte le righe del file di origine
            for (int count = 0; count < lines_count; count++)
            {
                // estrai la singola riga
                var linea = lines[count].ToString();

                // verifica che oggetto non sia null, per direttiva C#
                if (linea is not null)
                {
                    // variabile stringa, linea ancora con tabulazione
                    String lin_tab = linea as string;

                    // variabile stringa per salvare stringa con virgola
                    String lin_comma = "";

                    // mi creo variabile tab per il carattere di tabulazione
                    char tab = Convert.ToChar(9);

                    // sostituisco al carattere tab la virgola
                    lin_comma = lin_tab.Replace(tab, ',');

                    // estraggo le prime lettere per cercare la parola Classe

                    String is_classe = "";
                    if (lin_comma.Length > 6)
                    {
                        is_classe = lin_comma.Substring(0, 6);
                    }

                    // estraggo le prime lettere per carcare la parola Cognome

                    String is_cognome = "";
                    if (lin_comma.Length > 7)
                    {
                        is_cognome = lin_comma.Substring(0, 7);
                    }

                    // se la riga non contiene Cognome, non contiene Classe, e non è vuota, la ricopio

                    if ((is_classe != "Classe") && (is_cognome != "Cognome") && (lin_comma.Length > 0))
                    {
                        listClear.Items.Add(lin_comma);
                    }
                }
            }
            togliSpaziInizialiEFinaliToolStripMenuItem.Enabled = true;
        }

        private void togliSpaziInizialiEFinaliToolStripMenuItem_Click(object sender, EventArgs e)
        {
            // metti nella variabile lines le linee di testo del file
            ListBox.ObjectCollection lines = listClear.Items;

            // salva quante righe sono, da usare per il ciclo FOR
            int lines_count = listClear.Items.Count;

            String singola_riga;
            // cicla su tutte le righe del file di origine
            for (int count = 0; count < lines_count; count++)
            {
                singola_riga = "";
                // estrai la singola riga
                var linea = lines[count].ToString();

                // verifica che oggetto non sia null, per direttiva C#
                if (linea is not null)
                {
                    // variabile stringa, linea ancora con tabulazione
                    String lin_space = linea as string;
                    String[] single_lines = lin_space.Split(',');


                    String sb = "";
                    for (int cont = 0; cont < single_lines.Count(); cont++)
                    {
                        single_lines[cont] = single_lines[cont].Trim();
                        sb = sb + single_lines[cont];
                        if (cont != single_lines.Count() - 1)
                        {
                            sb = sb + ",";
                        }
                    }
                    singola_riga = singola_riga + sb.ToString();

                }
                lista_studenti.Items.Add(singola_riga);
            }
            generaOutputFinaleToolStripMenuItem.Enabled = true;
        }

        private string MD5Code(string pass)
        {
            string password = pass;

            // byte array representation of that string
            byte[] encodedPassword = new UTF8Encoding().GetBytes(password);

            // need MD5 to calculate the hash
            byte[] hash = ((HashAlgorithm)CryptoConfig.CreateFromName("MD5")).ComputeHash(encodedPassword);

            // string representation (similar to UNIX format)
            string encoded = BitConverter.ToString(hash)
               // without dashes
               .Replace("-", string.Empty)
               // make lowercase
               .ToLower();

            return encoded;
            // encoded contains the hash you want
        }

        private void generaStruttura_Click(object sender, EventArgs e)
        {
            int numero_studenti = lista_studenti.Items.Count;
            // given, a password in a string
        
            DatiStudente[] vettore_studenti;

            // metti nella variabile lines le linee di testo del file
            ListBox.ObjectCollection lines = lista_studenti.Items;

            vettore_studenti = new DatiStudente[numero_studenti];

            for (int count = 0; count < numero_studenti; count++)
            {

                DatiStudente current = vettore_studenti[count];
                var riga_corrente = lines[count].ToString();

                if (riga_corrente is not null)
                {
                    String riga_studente = riga_corrente as string;
                    string[] campi = riga_studente.Split(',');

                    vettore_studenti[count].cognome = campi[0];
                    vettore_studenti[count].nome = campi[1];
                    vettore_studenti[count].classe = campi[2];
                    vettore_studenti[count].cognome_padre = campi[3];
                    vettore_studenti[count].nome_padre = campi[4];
                    vettore_studenti[count].utente_padre = campi[5];
                    vettore_studenti[count].cognome_madre = campi[6];
                    vettore_studenti[count].nome_madre = campi[7];
                    vettore_studenti[count].utente_madre = campi[8];
                    vettore_studenti[count].cognome_tutore = campi[9];
                    vettore_studenti[count].nome_tutore = campi[10];
                    vettore_studenti[count].utente_tutore = campi[11];
                    vettore_studenti[count].cognome_affidatario = campi[12];
                    vettore_studenti[count].nome_affidatario = campi[13];
                    vettore_studenti[count].utente_affidatario = campi[14];
                    vettore_studenti[count].cognome_affidataria = campi[15];
                    vettore_studenti[count].nome_affidataria = campi[16];
                    vettore_studenti[count].utente_affidataria = campi[17];

                }

            }

            ///

            listOutput.Items.Clear();
            //listOutput.Items.Add("idUtemte,cognome,nome,cognome_genitore,nome_genitore,nomeutente,classe,password,cambiata");
            int id_studente = 1;
            //string password = "5f4d584c77691412828042bc81caec15"; /// anno 2024
            string password = MD5Code(tbDefaultPassword.Text);
            for (int count = 0; count < numero_studenti; count++)
            {
                DatiStudente curr = vettore_studenti[count];
                string rs;
                rs = "," + curr.cognome + "," + curr.nome + ",";

                if (curr.utente_padre != "")
                {
                    string rs_padre = curr.cognome_padre + "," + curr.nome_padre + "," + curr.utente_padre + "," + password + ",no," + curr.classe;
                    string nuova_riga = id_studente.ToString() + rs + rs_padre;
                    listOutput.Items.Add(nuova_riga);
                    id_studente++;
                }

                if (curr.utente_madre != "")
                {
                    string rs_madre = curr.cognome_madre + "," + curr.nome_madre + "," + curr.utente_madre + "," + password + ",no," + curr.classe;
                    string nuova_riga = id_studente.ToString() + rs + rs_madre;
                    listOutput.Items.Add(nuova_riga);
                    id_studente++;
                }

                if (curr.utente_tutore != "")
                {
                    string rs_tutore = curr.cognome_tutore + "," + curr.nome_tutore + "," + curr.utente_tutore + "," + password + ",no," + curr.classe;
                    string nuova_riga = id_studente.ToString() + rs + rs_tutore;
                    listOutput.Items.Add(nuova_riga);
                    id_studente++;
                }

                if (curr.utente_affidatario != "")
                {
                    string rs_affidatario = curr.cognome_affidatario + "," + curr.nome_affidatario + "," + curr.utente_affidatario + "," + password + ",no," + curr.classe;
                    string nuova_riga = id_studente.ToString() + rs + rs_affidatario;
                    listOutput.Items.Add(nuova_riga);
                    id_studente++;
                }

                if (curr.utente_affidataria != "")
                {
                    string rs_affidataria = curr.cognome_affidataria + "," + curr.nome_affidataria + "," + curr.utente_affidataria + "," + password + ",no," + curr.classe;
                    string nuova_riga = id_studente.ToString() + rs + rs_affidataria;
                    listOutput.Items.Add(nuova_riga);
                    id_studente++;
                }

            }

            if (DialogSalvaFileCSV.ShowDialog() == DialogResult.OK)
            {

                StreamWriter writer = new StreamWriter(DialogSalvaFileCSV.FileName);

                for (int count = 0; count < listOutput.Items.Count; count++)
                {
                    writer.WriteLine((string)listOutput.Items[count]);
                }

                writer.Close();

                MessageBox.Show("Salvataggio completato con successo.");
                Application.Exit();
            }
        }

        private void label1_Click(object sender, EventArgs e)
        {

        }

        private void label3_Click(object sender, EventArgs e)
        {

        }
    }
}
